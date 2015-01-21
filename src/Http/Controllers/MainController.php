<?php

/*
 * This file is part of Starbs Meh.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 * (c) Chip Wolf <hello@chipwolf.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Starbs\Meh\Http\Controllers;

use Starbs\Http\Controllers\AbstractController;

class MainController extends AbstractController
{
    /**
     * Do some clever things, then return a response.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function fire()
    {
        $url = $this->container->get('shortener')->full($this->args['id']);

        if ($url) {
            return $this->redirect($url);
        }

        return $this->error(['message' => 'Not Found'], 404);
    }
}
