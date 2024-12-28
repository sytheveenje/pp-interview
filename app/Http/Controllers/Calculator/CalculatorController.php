<?php

namespace App\Http\Controllers\Calculator;

use App\Actions\Calculations\GetCalculationsFromDatabase;
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
     * Get calculations from database
     * used for showing history
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function show(Request $request): JsonResponse
    {
        $calculations = GetCalculationsFromDatabase::run();

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

    /**
     * Delete a calculation
     *
     * @param Calculation $calculation
     * @return JsonResponse
     */
    public function delete(Calculation $calculation): JsonResponse
    {
        $calculation->delete();

        return response()->json(['Calculation deleted'], 204);
    }

    /**
     * Destroy all calculations
     */
    public function destroy(): JsonResponse
    {
        Calculation::query()->delete();

        return response()->json(['All calculations deleted'], 204);
    }
}
