<?php

/*
 * This file is part of Starbs Meh.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 * (c) Michael Banks <chip@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Starbs\Meh\Console\Commands;

use InvalidArgumentException;
use Starbs\Console\Commands\AbstractCommand;
use Starbs\Meh\Exceptions\BlacklistedUrlException;
use Starbs\Meh\Exceptions\InvalidUrlException;
use Starbs\Meh\Exceptions\NoUrlException;
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
        try {
            $this->container->get('validator')->validate($url);
            $short = $this->container->get('shortener')->short($url);
            $this->output->writeln("<info>'$url' was sucessfully shortened to '$short'.</info>");
        } catch (NoUrlException $e) {
            $this->output->writeln("<error>'$url' cannot be empty.</error>");
        } catch (InvalidUrlException $e) {
            $this->output->writeln("<error>'$url' is not a valid url.</error>");
        } catch (BlacklistedUrlException $e) {
            $this->output->writeln("<info>'$url' was sucessfully shortened to '$url'.</info>");
        }
    }
}
