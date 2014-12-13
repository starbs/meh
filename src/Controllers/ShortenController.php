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

namespace GrahamCampbell\Meh\Controllers;

class ShortenController extends AbstractController
{
    protected function fire()
    {
        $url = $this->input('url');

        if (!$url) {
            return $this->error(['message'  => 'No URL Provided'], 400);
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return $this->error(['message'  => 'The Provided URL Was Invalid'], 400);
        }

        $short = $this->app['shortener']->short($url);

        return $this->success(['message'  => 'URL Shortened Successfully', 'url' => $short]);
    }
}
