<?php

namespace App\Enums;

use NXP\Exception\IncorrectExpressionException;
use NXP\Exception\UnknownOperatorException;
use NXP\Exception\IncorrectBracketsException;
use NXP\Exception\UnknownVariableException;

enum CalculatorError: string
{
    case INPUT_REQUIRED = 'The input field is required';
    case INPUT_STRING = 'The input field must be a string';
    case INPUT_MAX = 'The input field must not exceed 255 characters';
    case INCORRECT_EXPRESSION = 'Incorrect expression';
    case UNKNOWN_OPERATOR = 'Unknown operator';
    case INCORRECT_BRACKETS = 'Incorrect brackets';
    case UNKNOWN_VARIABLE = 'Unknown variable';
    case UNKNOWN_ERROR = 'An unknown error occurred';

    /**
     * Map an exception to a CalculatorError enum value.
     * Used to convert exceptions to error messages.
     *
     * @param \Exception $e
     * @return self
     */
    public static function fromException(\Exception $e): self
    {
        return match ($e::class) {
            IncorrectExpressionException::class => self::INCORRECT_EXPRESSION,
            UnknownOperatorException::class => self::UNKNOWN_OPERATOR,
            IncorrectBracketsException::class => self::INCORRECT_BRACKETS,
            UnknownVariableException::class => self::UNKNOWN_VARIABLE,
            default => self::UNKNOWN_ERROR,
        };
    }
}
