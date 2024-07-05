<?php

namespace App\Service;

use GuzzleHttp\Client;

class OmdbClient
{
    public function __construct(private readonly Client $client)
    {
    }

}
