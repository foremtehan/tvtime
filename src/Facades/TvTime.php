<?php

namespace TvTime\Facades;

use TvTime\TvTimeClient;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * @method static int followers(string $title)
 * @method static Collection search(string $title)
 */
class TvTime extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return TvTimeClient::class;
    }
}