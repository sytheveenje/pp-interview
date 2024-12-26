<?php

namespace App\Http\Controllers\Calculator;

use App\Actions\Calculations\StoreCalculation;
use App\Contracts\CalculatorInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalculationRequest;
use Illuminate\Http\JsonResponse;

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
     * Handle calculation requests.
     *
     * @param CalculationRequest $request
     * @return JsonResponse
     */
    public function __invoke(CalculationRequest $request): JsonResponse
    {
        $input = $request->input('input');

        if (!$input) {
            return response()->json(['error' => 'Input is required'], 302);
        }

        $result = $this->calculator->calculate($input);

        if ($result instanceof \Exception) {
            return response()->json([
                'input' => $input,
                'error' => $result->getMessage()
            ], 302);
        }

        StoreCalculation::run($input, $result);

        return response()->json([
            'input' => $input,
            'result' => $result
        ], 200);
    }
}
