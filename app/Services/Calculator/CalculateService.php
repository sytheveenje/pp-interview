<?php

namespace App\Services\Calculator;

use App\Contracts\CalculatorInterface;
use NXP\Exception\IncorrectExpressionException;
use NXP\Exception\UnknownOperatorException;
use NXP\Exception\IncorrectBracketsException;
use NXP\Exception\UnknownVariableException;

class CalculateService implements CalculatorInterface
{
    private $calculator;

    /**
     * @param $calculator
     */
    public function __construct($calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param string $expression
     * @return float|int|\Exception
     */
    public function calculate(string $expression): float|int|\Exception
    {
        try {
            return $this->calculator->execute($expression);
        } catch (\Exception $e) {
            $exceptionMessages = [
                IncorrectExpressionException::class => 'Incorrect expression',
                UnknownOperatorException::class => 'Unknown operator',
                IncorrectBracketsException::class => 'Incorrect brackets',
                UnknownVariableException::class => 'Unknown variable',
            ];

            return new \Exception($exceptionMessages[$e::class] ?? 'An unknown error occurred');
        }
    }
}