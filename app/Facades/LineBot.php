<?php

namespace App\Facades;

/**
 * Class LineBot
 * @package App\Facades
 *
 * @mixin \LINE\LINEBot
 */
class LineBot
{
    protected static function getFacadeAccessor(): string
    {
        return 'line-bot';
    }
}
