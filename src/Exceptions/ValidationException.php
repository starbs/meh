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

use Exception;

class ValidationException extends Exception
{
    public function __construct($message)
    {
        if ($message) {
            parent::__construct($message);
        } else {
            parent::__construct('Validation failed.');
        }
    }
}
