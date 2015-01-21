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
use Starbs\Meh\Exceptions\BlacklistedUrlException;
use Starbs\Meh\Exceptions\InvalidUrlException;
use Starbs\Meh\Exceptions\NoUrlException;

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
            return $this->getShortenError('No URL provided');
        } catch (InvalidUrlException $e) {
            return $this->getShortenError('The provided URL was invalid');
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

        return $this->success(['message' => 'URL shortened successfully', 'url' => $url]);
    }

    protected function getShortenError($message)
    {
        return $this->error(['message'  => $message], 400);
    }
}
