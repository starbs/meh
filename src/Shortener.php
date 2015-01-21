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

namespace Starbs\Meh;

use Hashids\Hashids;
use Starbs\Meh\Models\Url;

class Shortener
{
    protected $hash;
    protected $url;

    public function __construct(Hashids $hash, $url)
    {
        $this->hash = $hash;
        $this->url = $url;
    }

    public function short($full)
    {
        $hash = sha1($full);

        $model = Url::where('hash', $hash)->first();

        if (!$model) {
            $model = Url::create(['hash' => $hash, 'full' => $full]);
        }

        if ($model) {
            return $this->url($model->id);
        }
    }

    public function full($id)
    {
        $id = $this->decode($id);

        if ($model = Url::where('id', $id)->first()) {
            return $model->full;
        }
    }

    public function remove($id)
    {
        $id = $this->decode($id);

        if ($model = Url::where('id', $id)->first()) {
            return $model->delete();
        }
    }

    protected function url($id)
    {
        $id = $this->encode($id);

        return $this->url.'/'.$id;
    }

    protected function encode($id)
    {
        return $this->hash->encode($id);
    }

    protected function decode($id)
    {
        if (is_numeric($id)) {
            return (int) $id;
        } else {
            return $this->hash->decode($id);
        }
    }
}
