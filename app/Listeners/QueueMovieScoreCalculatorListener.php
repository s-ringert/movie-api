<?php

namespace App\Listeners;

use App\Events\MovieVoted;
use App\Jobs\MovieScoreCalculatorJob;

class QueueMovieScoreCalculatorListener
{
    public function __construct() {}

    public function handle(MovieVoted $event): void
    {
        MovieScoreCalculatorJob::dispatch($event->getMovieDto());
    }
}
