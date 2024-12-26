<?php

namespace App\Actions\Calculations;

use App\Models\Calculation;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreCalculation
{
    use AsAction;

    /**
     * @param string $input
     * @param string $result
     * @return Calculation
     */
    public function handle(string $input, string $result): Calculation
    {
        return Calculation::create([
            'input' => $input,
            'result' => $result,
        ]);
    }
}
