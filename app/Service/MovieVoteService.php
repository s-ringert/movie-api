<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\MovieDTO;
use App\Events\MovieVoted;
use App\Models\Movie;
use App\Models\User;

final class MovieVoteService
{
    public function __construct() {}

    public function vote(User $user, Movie $movie, int $score): void
    {
        $user->movies()->attach($movie, ['score' => $score]);
        $user->save();

        MovieVoted::dispatch(MovieDTO::createFromMovie($movie));
    }
}
