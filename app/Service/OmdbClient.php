<?php

namespace App\Service;

use GuzzleHttp\Client;

class OmdbClient
{
    private const API_BASE_URL = 'https://omdbapi.com';

    public function __construct(private readonly Client $client, private readonly string $omdbApiKey) {}
}
