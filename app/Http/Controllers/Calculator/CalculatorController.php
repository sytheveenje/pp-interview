<?php

namespace App\Http\Controllers\Calculator;

use App\Contracts\CalculatorInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use NXP\Exception\IncorrectBracketsException;
use NXP\Exception\IncorrectExpressionException;
use NXP\Exception\UnknownOperatorException;
use NXP\Exception\UnknownVariableException;
use NXP\MathExecutor;
class CalculatorController extends Controller
{

    protected CalculatorInterface $calculator;

    /**
     * @param CalculatorInterface $calculator
     */
    public function __construct(CalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @throws IncorrectExpressionException
     * @throws UnknownOperatorException
     * @throws IncorrectBracketsException
     * @throws UnknownVariableException
     */
    public function __invoke(Request $request): JsonResponse
    {
        // Get the input from the request
        $input = $request->input('input');

        if(!$input){
            return response()->json(['error' => 'Input is required'], 400);
        }

        // Perform the calculation
        $result = $this->calculator->calculate($input);

        // Return the result
        return response()->json(['input' => $input, 'result' => $result], 200);
    }
}
