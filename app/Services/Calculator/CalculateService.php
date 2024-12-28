<?php

namespace App\Services\Calculator;

use App\Contracts\CalculatorInterface;
use App\Enums\CalculatorError;
use NXP\Exception\IncorrectExpressionException;
use NXP\Exception\UnknownOperatorException;
use NXP\Exception\IncorrectBracketsException;
use NXP\Exception\UnknownVariableException;
use NXP\MathExecutor;

class CalculateService implements CalculatorInterface
{
    /**
     * @var MathExecutor
     */
    protected MathExecutor $calculator;

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
            return new \Exception(CalculatorError::fromException($e)->value);
        }
    }
}