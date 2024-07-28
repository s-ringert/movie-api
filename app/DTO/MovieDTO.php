<?php

declare(strict_types=1);

namespace App\DTO;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

final readonly class MovieDTO implements \JsonSerializable
{
    private function __construct(
        private string $title,
        private int $year,
        private string $imdbId,
        private float $score = 0.0
    ) {}

    public static function create(
        string $title, int $year, string $imdbId, float $score = 0.0
    ): self {
        return new self($title, $year, $imdbId, $score);
    }

    public static function createFromMovie(Movie $movie): self
    {
        return new self(
            $movie->getTitle(),
            $movie->getYear(),
            $movie->getImdbId(),
            $movie->getScore()
        );
    }

    public static function createByCollection(Collection $collection): array
    {
        $movieList = [];
        foreach ($collection as $movie) {
            $movieList[] = MovieDTO::create(
                $movie->title, $movie->year, $movie->imdb_id, $movie->score
            );
        }

        return $movieList;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getImdbId(): string
    {
        return $this->imdbId;
    }

    public function getScore(): float
    {
        return $this->score;
    }

    public function jsonSerialize(): array
    {
        return [
            'title' => $this->title,
            'year' => $this->year,
            'score' => $this->score,
        ];
    }
}
