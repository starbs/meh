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

use Starbs\Meh\Exceptions\BlacklistedUrlException;
use Starbs\Meh\Exceptions\InvalidUrlException;
use Starbs\Meh\Exceptions\NoUrlException;

class Validator
{
    protected $blackist;

    public function __construct($blacklist)
    {
        $this->blacklist = $blacklist;
    }

    public function validate($url)
    {
        if (!$url) {
            throw new NoUrlException();
        }

        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new InvalidUrlException();
        }

        foreach ($this->blacklist as $pattern) {
            if (preg_match($pattern, $url)) {
                throw new BlacklistedUrlException();
            }
        }
    }
}
