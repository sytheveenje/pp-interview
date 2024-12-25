<?php

namespace App\Contracts;

interface CalculatorInterface
{
    /**
     * Perform a calculation based on the input string.
     *
     * @param string $expression
     * @return float|int
     */
    public function calculate(string $expression): float|int;
}