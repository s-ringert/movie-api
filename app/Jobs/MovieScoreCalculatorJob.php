<?php
declare(strict_types=1);

namespace App\Jobs;

use App\DTO\MovieDTO;
use App\Service\MovieScoreCalculatorService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

final class MovieScoreCalculatorJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        private readonly MovieDTO $movieDTO,
    )
    {
    }

    public function handle(MovieScoreCalculatorService $movieScoreCalculator): void
    {
        $movieScoreCalculator->updateMovieScore($this->movieDTO);
    }
}
