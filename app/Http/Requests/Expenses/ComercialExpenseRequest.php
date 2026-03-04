<?php

namespace App\Http\Requests\Expenses;

class ComercialExpenseRequest extends BaseExpenseRequest
{
    public function rules(): array
    {
        $rules = parent::rules();

        $rules['supplier_id'] = 'required|exists:suppliers,id';

        $rules['tax'] = 'nullable|numeric|min:0';

        return $rules;
    }
}
