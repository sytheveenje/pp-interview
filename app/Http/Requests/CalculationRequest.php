<?php

namespace App\Http\Requests;

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
                'regex:/^(\d+|\+|\-|\*|\/|\^|\(|\)|,|\.|abs|acos|acosh|arccos|arccosec|arccot|arccotan|arccsc|arcctg|arcsec|arcsin|arctan|arctg|array|asin|atan|atan2|atanh|atn|avg|bindec|ceil|cos|cosec|cosh|cot|cotan|cotg|csc|ctg|ctn|decbin|dechex|decoct|deg2rad|exp|expm1|floor|fmod|hexdec|hypot|if|intdiv|lg|ln|log|log10|log1p|max|median|min|octdec|pi|pow|rad2deg|round|sec|sin|sinh|sqrt|tan|tanh|tg|tn|\s)+$/i'
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
