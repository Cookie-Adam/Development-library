<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'book_id' => ['required', 'exists:books,id'],
            'staff_id' => ['required', 'exists:staff,id'],
            'due_at' => ['required', 'date', 'after_or_equal:today'],
        ];
    }
}
