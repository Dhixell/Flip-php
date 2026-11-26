<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:media,title',
            'type' => 'required|in:movie,music',
            'genre' => 'required|string|max:255',
            'duration_minutes' => 'required|integer|min:1',
            'release_year' => 'required|integer|min:1900|max:2100',
        ];
    }
}
