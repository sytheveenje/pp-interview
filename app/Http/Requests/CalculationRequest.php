<?php

namespace App\Http\Requests;

use App\Enums\CalculatorError;
use Illuminate\Foundation\Http\FormRequest;

class CalculationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'input' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function messages()
    {
        return [
            'input.required' => CalculatorError::INPUT_REQUIRED->value,
            'input.string' => CalculatorError::INPUT_STRING->value,
            'input.max' => CalculatorError::INPUT_MAX->value,
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
