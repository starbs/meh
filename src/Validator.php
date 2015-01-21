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
