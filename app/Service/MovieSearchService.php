<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\MovieDTO;
use App\Models\Movie;

final class MovieSearchService
{
    public function __construct(
        private readonly OmdbClient $omdbClient
    ) {}

    public function search(string $movieTitle): array
    {
        $foundMovies = $this->searchWithDatabase($movieTitle);
        if (count($foundMovies) > 0) {
            return $foundMovies;
        }
        $foundMovies = $this->searchWithClient($movieTitle);
        $this->updateDatabase(...$foundMovies);

        return $foundMovies;
    }

    private function searchWithDatabase(string $movieTitle): array
    {
        $movieCollection = Movie::where('title', 'LIKE', "%{$movieTitle}%")->get();

        return MovieDTO::createByCollection($movieCollection);
    }

    private function searchWithClient(string $movieTitle): array
    {
        $searchResponse = $this->omdbClient->searchMovie($movieTitle);

        $movieList = [];
        foreach ($searchResponse as $movieResponse) {
            $movieList[] = MovieDTO::create(
                $movieResponse['Title'],
                (int) $movieResponse['Year'],
                $movieResponse['imdbID']
            );
        }

        $this->updateDatabase(...$movieList);

        return $movieList;
    }

    private function updateDatabase(MovieDTO ...$movieDTOs): void
    {
        $updateData = [];
        foreach ($movieDTOs as $movieDTO) {
            $updateData[] = [
                'title' => $movieDTO->getTitle(),
                'year' => $movieDTO->getYear(),
                'imdb_id' => $movieDTO->getImdbID(),
            ];
        }
        Movie::upsert($updateData, ['imdb_id'], ['title', 'year']);
    }
}
