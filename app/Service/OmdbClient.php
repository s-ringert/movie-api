<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

final class OmdbClient
{
    public function __construct() {}

    public function searchMovie(string $movieTitle): array
    {
        $response = Http::get(
            Config::get('services.omdb.base_url'),
            [
                'apikey' => Config::get('services.omdb.api_key'),
                's' => $movieTitle,
                'type' => 'movie',
            ]
        );

        return $response->json('Search') ?? [];
    }
}
