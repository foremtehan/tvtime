<?php

namespace TvTime;

use Throwable;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

class TvTimeClient
{

    public function __construct(public Factory $client)
    {
        //
    }

    public function search(string $title): Collection
    {
        return Http::withHeaders(['X-Requested-With' => 'XMLHttpRequest'])
            ->get("https://www.tvtime.com/search?q=$title&limit=20")
            ->collect();
    }

    public function followers(string $title): int
    {
        try {
            $searchResult = $this->search($title);

            if ($searchResult->isEmpty()) {
                return 0;
            }

            $url = "https://www.tvtime.com{$searchResult->only(0)->collapse()->get('url')}";

            return Str::of(Http::get($url)->body())->match('~\((\d+) followers on~')->value();
        } catch (Throwable) {
            return 0;
        }
    }
}