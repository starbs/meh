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

namespace Starbs\Meh\Console\Commands;

use InvalidArgumentException;
use Starbs\Console\Commands\AbstractCommand;
use Symfony\Component\Console\Input\InputArgument;

class ShortenCommand extends AbstractCommand
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'shorten';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Shorten the given urls';

    /**
     * Configures the command.
     *
     * This method is called by the parent's constructor.
     *
     * @return void
     */
    protected function configure()
    {
        $this->addArgument('urls', InputArgument::IS_ARRAY, 'The urls to shorten');
    }

    /**
     * Executes the command.
     *
     * @return void
     */
    protected function fire()
    {
        if ($urls = $this->input->getArgument('urls')) {
            foreach ($urls as $url) {
                $this->shorten($url);
            }
        } else {
            throw new InvalidArgumentException('You need to provide one or more urls to shorten.');
        }
    }

    /**
     * Shorten the url and persist it to the db.
     *
     * @param string $url
     *
     * @return void
     */
    protected function shorten($url)
    {
        if (filter_var($url, FILTER_VALIDATE_URL)) {
            $short = $this->container->get('shortener')->short($url);
            $this->output->writeln("<info>'$url' was sucessfully shortened to '$short'.</info>");
        } else {
            $this->output->writeln("<error>'$url' is not a valid url.</error>");
        }
    }
}
