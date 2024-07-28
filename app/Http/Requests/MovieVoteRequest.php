<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Models\Movie;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Validator;

final class MovieVoteRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'score' => ['required', 'integer', 'min:1', 'max:5'],
        ];
    }

    public function after(): array
    {
        return [
            function (Validator $validator) {
                $movie = Movie::find($this->route('movieId'));
                if ($movie->users()->where('user_id', $this->user()->id)
                    ->exists()
                ) {
                    $validator->errors()->add(
                        'score',
                        'already voted'
                    );
                }
            },
        ];
    }

    protected function failedValidation(
        \Illuminate\Contracts\Validation\Validator $validator
    ) {
        throw new HttpResponseException(
            response()->json([$validator->getMessageBag()], 422)
        );
    }
}
