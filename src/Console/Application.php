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

namespace Starbs\Meh\Console;

use Starbs\Console\AbstractApplication;
use Starbs\Meh\Console\Commands\RemoveCommand;
use Starbs\Meh\Console\Commands\ShortenCommand;

class Application extends AbstractApplication
{
    /**
     * The application name.
     *
     * @var string
     */
    protected $appName = 'Starbs Meh';

    /**
     * The application version.
     *
     * @var string
     */
    protected $appVersion = '1.1.0';

    /**
     * Setup the application.
     *
     * @return void
     */
    protected function setup()
    {
        $this->add($this->container->get(RemoveCommand::class));
        $this->add($this->container->get(ShortenCommand::class));
    }
}
