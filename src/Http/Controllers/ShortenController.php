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

use Starbs\Meh\Exceptions\BlacklistedUrlException;
use Starbs\Meh\Exceptions\InvalidUrlException;
use Starbs\Meh\Exceptions\NoUrlException;
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

        try {
            $this->container->get('validator')->validate($url);
        } catch (NoUrlException $e) {
            return $this->getShortenError('No URL Provided');
        } catch (InvalidUrlException $e) {
            return $this->getShortenError('The Provided URL Was Invalid');
        } catch (BlacklistedUrlException $e) {
            return $this->getShortenSuccess($url);
        }

        $short = $this->container->get('shortener')->short($url);

        return $this->getShortenSuccess($short);
    }

    protected function getShortenSuccess($url)
    {
        if ($this->input('sharex')) {
            return $this->raw($url, 'text/plain');
        }

        return $this->success(['message' => 'URL Shortened Successfully', 'url' => $url]);
    }

    protected function getShortenError($message)
    {
        return $this->error(['message'  => $message], 400);
    }
}
