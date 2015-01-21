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

$app->get('/', 'Starbs\Meh\Http\Controllers\HomeController::index');

$app->post('/', 'Starbs\Meh\Http\Controllers\ShortenController::index');

$app->get('/{id}', 'Starbs\Meh\Http\Controllers\MainController::index');
