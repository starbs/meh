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

namespace Starbs\Meh\Http\Controllers;

use Starbs\Http\Controllers\AbstractController;

class ShortenController extends AbstractController
{
    /**
     * Do some clever things, then return a response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function fire()
    {
        $url = $this->input('url');

        if (!$url) {
            return $this->error(['message'  => 'No URL Provided'], 400);
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->error(['message'  => 'The Provided URL Was Invalid'], 400);
        }

        $short = $this->container->get('shortener')->short($url);

        if ($this->input('sharex')) {
            return $this->raw($short, 'text/plain');
        }

        return $this->success(['message'  => 'URL Shortened Successfully', 'url' => $short]);
    }
}
