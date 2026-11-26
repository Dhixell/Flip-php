<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $medium = $this->route('medium');

        return [
            'title' => [
                'sometimes',
                'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($medium),
            ],
            'type' => 'sometimes|required|in:movie,music',
            'genre' => 'sometimes|required|string|max:255',
            'duration_minutes' => 'sometimes|required|integer|min:1',
            'release_year' => 'sometimes|required|integer|min:1900|max:2100',
        ];
    }
}
