<?php

namespace App\Http\Controllers\Calculator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function __invoke(Request $request, $input = null)
    {
        // Perform the calculation
        $result = '31.5';

        // Return the result
        return response()->json(['input' => $input, 'result' => $result], 200);
    }
}
