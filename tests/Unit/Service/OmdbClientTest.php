<?php

namespace Tests\Unit\Service;

use App\Service\OmdbClient;
use Illuminate\Support\Facades\Http;

class OmdbClientTest extends \Tests\TestCase
{
    public function testSearchWithResult()
    {
        Http::preventStrayRequests();
        $omdbClient = new OmdbClient();
        Http::fake([
            '*' => Http::response([
                'Search' => [
                    [
                        'Title' => 'Star Wars: Episode IV - A New Hope',
                        'Year' => 1977
                    ],
                    [
                        'Title' => 'Star Wars: Episode V - The Empire Strikes Back',
                        'Year' => 1980
                    ]
                ]
            ])
        ]);

        $result = $omdbClient->searchMovie('FOOBAR');


        Http::assertSentCount(1);
        $this->assertCount(2, $result);
        $this->assertEquals(
            [
                [
                    'Title' => 'Star Wars: Episode IV - A New Hope',
                    'Year' => 1977
                ],
                [
                    'Title' => 'Star Wars: Episode V - The Empire Strikes Back',
                    'Year' => 1980
                ]
            ],
            $result
        );
    }
    public function testSearchWithNoResult()
    {
        Http::preventStrayRequests();
        $omdbClient = new OmdbClient();
        Http::fake([
            '*' => Http::response()
        ]);

        $result = $omdbClient->searchMovie('FOOBAR');


        Http::assertSentCount(1);
        $this->assertCount(0, $result);
        $this->assertEquals(
            [
            ],
            $result
        );
    }
}
