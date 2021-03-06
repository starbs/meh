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

namespace Starbs\Meh\Exceptions;

class BlacklistedUrlException extends ValidationException
{
    public function __construct()
    {
        parent::__construct('Validation failed: blacklisted url.');
    }
}
