<?php

/**
 * This file is part of Meh by Graham Campbell.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace GrahamCampbell\Meh;

use GrahamCampbell\Meh\Models\Url;
use Proton\Application;

class Shortener
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    protected function url($id)
    {
        $id = $this->encode($id);

        return $this->app['url'].'/'.$id;
    }

    public function short($full)
    {
        $hash = sha1($full);

        $model = URL::where('hash', $hash)->first();

        if (!$model) {
            $model = Url::create(['hash' => $hash, 'full' => $full]);
        }

        if ($model) {
            return $this->url($model->id);
        }
    }

    public function full($id)
    {
        $id = $this->decode($id);

        if ($model = Url::where('id', $id)->first()) {
            return $model->full;
        }
    }

    public function remove($id)
    {
        $id = $this->decode($id);

        if ($model = Url::where('id', $id)->first()) {
            return $model->delete();
        }
    }

    protected function encode($id)
    {
        return $this->app['hash']->encode($id);
    }

    protected function decode($id)
    {
        if (is_numeric($id)) {
            return (int) $id;
        } else {
            return $this->app['hash']->decode($id);
        }
    }
}
