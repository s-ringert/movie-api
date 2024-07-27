<?php
declare(strict_types=1);

namespace App\Service;

use App\DTO\MovieDTO;
use App\Jobs\MovieScoreCalculatorJob;
use App\Models\Movie;
use App\Models\User;

final class MovieVoteService
{
    public function __construct(private readonly MovieScoreCalculatorService $movieScoreCalculator)
    {
    }

    public function vote(User $user, Movie $movie, int $score): void {
        $user->movies()->attach($movie, ['score' => $score]);
        $user->save();

        $this->movieScoreCalculator->updateMovieScore(MovieDTO::createFromMovie($movie));

        MovieScoreCalculatorJob::dispatch(MovieDTO::createFromMovie($movie));
    }
}
