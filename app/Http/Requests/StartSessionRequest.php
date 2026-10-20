<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StartSessionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'client_id' => ['required', 'exists:clients,id'],
            'computer_id' => ['required', 'exists:computers,id'],
            'staff_id' => ['required', 'exists:staff,id'],
        ];
    }
}
