<?php

/*
 * This file is part of Starbs Meh by Graham Campbell.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Starbs\Meh;

use Hashids\Hashids;
use Starbs\Meh\Models\Url;

class Shortener
{
    protected $hash;
    protected $url;

    public function __construct(Hashids $hash, $url)
    {
        $this->hash = $hash;
        $this->url = $url;
    }

    public function short($full)
    {
        $hash = sha1($full);

        $model = Url::where('hash', $hash)->first();

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

    protected function url($id)
    {
        $id = $this->encode($id);

        return $this->url.'/'.$id;
    }

    protected function encode($id)
    {
        return $this->hash->encode($id);
    }

    protected function decode($id)
    {
        if (is_numeric($id)) {
            return (int) $id;
        } else {
            return $this->hash->decode($id);
        }
    }
}
