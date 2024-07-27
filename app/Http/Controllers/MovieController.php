<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Service\MovieSearchService;
use App\Service\MovieVoteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class MovieController extends Controller
{
    public function __construct(
        private readonly MovieSearchService $movieSearchService,
        private readonly MovieVoteService $movieVoteService,
    )
    {
    }

    public function search(string $movieTitle): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            $this->movieSearchService->search($movieTitle),
        ]);
    }

    public function getMovieDetails(int $movieId): JsonResponse
    {
        //@TODO auslagern in Repository
        return response()->json([
            Movie::find($movieId),
        ]);
    }

    public function vote(Request $request, int $movieId): JsonResponse{
        $user = $request->user();
        $score = $request->json()->get('score');
        $movie = Movie::find($movieId);

        $this->movieVoteService->vote(
            $user,
            $movie,
            $score
        );

        return response()->json([
            'vote counted'
        ]);
    }
}
