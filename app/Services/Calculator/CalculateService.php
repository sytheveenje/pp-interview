<?php

namespace App\Services\Calculator;

use App\Contracts\CalculatorInterface;

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
     * @return float|int
     */
    public function calculate(string $expression): float|int
    {
        return $this->calculator->execute($expression);
    }
}
