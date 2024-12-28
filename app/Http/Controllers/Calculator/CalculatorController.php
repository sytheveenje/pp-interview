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

    /**
     * Get calculation history
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $calculations = Calculation::query()
            ->select('id', 'input', 'result', 'created_at')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            })
            ->map(function ($items, $date) {
                return [
                    'date' => $date,
                    'calculations' => $items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'input' => $item->input,
                            'result' => $item->result,
                            'created_at' => $item->created_at,
                        ];
                    })->values(),
                ];
            })->values();

        return response()->json($calculations, 200);
    }

    /**
     * Store calculation in database and return result
     *
     * @param CalculationRequest $request
     * @return JsonResponse
     */
    public function store(CalculationRequest $request): JsonResponse
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
