<?php

namespace App\Http\Controllers\Calculator;

use App\Actions\Calculations\StoreCalculation;
use App\Contracts\CalculatorInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CalculationRequest;
use App\Models\Calculation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function history(Request $request): JsonResponse
    {
        $history = Calculation::query()
            ->select('id', 'input', 'result', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function($item) {
                return $item->created_at->format('Y-m-d');
            });

        return response()->json($history, 200);
    }

    /**
     * Handle calculation requests.
     *
     * @param CalculationRequest $request
     * @return JsonResponse
     */
    public function calculate(CalculationRequest $request): JsonResponse
    {
        $input = $request->input('input');

        $result = $this->calculator->calculate($input);
        if ($result instanceof \Exception) {
            return response()->json(['input' => $input, 'error' => $result->getMessage()], 302);
        }

        StoreCalculation::run($input, $result);

        return response()->json([
            'input' => $input,
            'result' => $result
        ], 200);
    }
}
