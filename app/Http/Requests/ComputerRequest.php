<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ComputerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('computer')?->id;

        return [
            'name' => ['required', 'string', 'max:50', Rule::unique('computers', 'name')->ignore($id)],
            'status' => ['required', Rule::in(['available', 'in_use', 'maintenance'])],
        ];
    }
}
