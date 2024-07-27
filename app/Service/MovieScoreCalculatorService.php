<?php
declare(strict_types=1);

namespace App\Service;

use App\DTO\MovieDTO;
use App\Models\Movie;

final class MovieScoreCalculatorService
{
    public function updateMovieScore(MovieDTO $movieDTO): void
    {
        $movie = Movie::where('imdb_id', $movieDTO->getImdbId())->first();
        $users = $movie->users;

        $score = 0;
        foreach ($users as $user) {
            $score += $user->pivot->score;
        }
        $score = $score / count($users);
        $movie->score = $score;
        $movie->save();
    }
}
