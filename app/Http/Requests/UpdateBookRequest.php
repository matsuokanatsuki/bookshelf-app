<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:255'],
            'author' => ['required', 'max:255'],
            'isbn' => ['required', Rule::unique('books')->ignore($this->book->id)],
            'published_at' => ['required', 'date'],
            'description' => ['nullable'],
            'image_url' => ['nullable', 'url'],
            'genres' => ['required', 'array'],
            'genres.*' => ['exists:genres,id'],
        ];
    }
}
