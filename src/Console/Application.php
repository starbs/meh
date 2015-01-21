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
    protected $appVersion = '1.1.1-dev';

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
