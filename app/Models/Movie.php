<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsToMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable
        = [
            'title',
            'year',
            'imdb_id',
            'score',
        ];

    protected $attributes
        = [
            'score' => 0,
        ];

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('score');
    }

    public function getTitle(): string{
        return $this->title;
    }
    public function getYear(): int{
        return $this->year;
    }

    public function getImdbId(): string{
        return $this->imdb_id;
    }

    public function getScore(): int{
        return $this->score;
    }
}
