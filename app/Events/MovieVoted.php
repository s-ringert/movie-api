<?php

namespace App\Events;

use App\DTO\MovieDTO;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MovieVoted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(private readonly MovieDTO $movieDTO) {}

    public function getMovieDto(): MovieDTO
    {
        return $this->movieDTO;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
