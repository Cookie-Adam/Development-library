<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('book')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'isbn' => ['nullable', 'string', 'max:20', Rule::unique('books', 'isbn')->ignore($id)],
            'category' => ['nullable', 'string', 'max:100'],
            'copies' => ['required', 'integer', 'min:1'],
            // Only editable on update; on create it defaults to copies
            'available_copies' => ['nullable', 'integer', 'min:0', 'lte:copies'],
        ];
    }
}
