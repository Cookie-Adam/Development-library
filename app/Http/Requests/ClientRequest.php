<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('client')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255', Rule::unique('clients', 'email')->ignore($id)],
            'phone' => ['nullable', 'string', 'max:50'],
            'card_number' => ['required', 'string', 'max:50', Rule::unique('clients', 'card_number')->ignore($id)],
        ];
    }
}
