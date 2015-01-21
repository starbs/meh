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

namespace Starbs\Meh\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    /**
     * A list of methods protected from mass assignment.
     *
     * @var array
     */
    protected $guarded = ['_token', '_method', 'id'];
}
