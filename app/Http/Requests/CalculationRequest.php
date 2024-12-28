<?php

namespace App\Http\Requests;

use App\Enums\CalculatorError;
use Illuminate\Foundation\Http\FormRequest;

class CalculationRequest extends FormRequest
{
    /**
     * @return array[]
     */
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

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'input.required' => CalculatorError::INPUT_REQUIRED->value,
            'input.string' => CalculatorError::INPUT_STRING->value,
            'input.max' => CalculatorError::INPUT_MAX->value,
        ];
    }

    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }
}
