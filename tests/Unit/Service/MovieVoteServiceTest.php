<?php

namespace Tests\Unit\Service;

use App\Events\MovieVoted;
use App\Models\Movie;
use App\Models\User;
use App\Service\MovieVoteService;
use Illuminate\Support\Facades\Event;
use Mockery\Mock;
use Mockery\MockInterface;
use Tests\TestCase;

class MovieVoteServiceTest extends TestCase
{
    public function testVote()
    {
        Event::fake();

        $user = $this->mock(User::class, function (MockInterface $mock) {
            $mock->shouldReceive('attach')->once();
            $mock->shouldReceive('save')->once();
        });
        $movie = $this->mock(Movie::class, function (MockInterface $mock) {});

        $movieVoteService = new MovieVoteService();
        $movieVoteService->vote($user, $movie, 3);

        Event::assertDispatched(MovieVoted::class);
    }
}
