<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Service\MovieSearchService;

final class MovieController extends Controller
{
    public function __construct(
        private readonly MovieSearchService $movieSearchService,
    ) {}

    public function search(string $movieTitle): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            $this->movieSearchService->search($movieTitle),
        ]);
    }
}
