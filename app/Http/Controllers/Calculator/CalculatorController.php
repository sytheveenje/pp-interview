<?php

namespace App\Http\Controllers\Calculator;

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
    /**
     * @throws IncorrectExpressionException
     * @throws UnknownOperatorException
     * @throws IncorrectBracketsException
     * @throws UnknownVariableException
     */
    public function __invoke(Request $request, $input = null): JsonResponse
    {
        // Get the input from the request
        $input = 'sqrt(((((9*9)/12)+(13-4))*2)^2)';

        // Perform the calculation
        $executor = new MathExecutor();
        $result = $executor->execute($input);

        // Return the result
        return response()->json(['input' => $input, 'result' => $result], 200);
    }
}
