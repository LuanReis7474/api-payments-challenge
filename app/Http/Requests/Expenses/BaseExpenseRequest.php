<?php

namespace App\Http\Requests\Expenses;

use Illuminate\Foundation\Http\FormRequest;

class BaseExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:40',
            'value' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'category' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ];
    }
}
