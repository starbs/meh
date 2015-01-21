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

$app['hash'] = function () {
    return new Hashids\Hashids('meh', 4);
};

$app['shortener'] = function () use ($app) {
    return new Starbs\Meh\Shortener($app['hash'], $app['url']);
};

$app['validator'] = function () use ($app) {
    return new Starbs\Meh\Validator($app['blacklist']);
};
