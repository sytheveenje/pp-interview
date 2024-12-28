<?php

namespace Database\Factories;

use App\Models\Calculation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends Factory<Calculation>
 */
class CalculationFactory extends Factory
{
    protected $model = Calculation::class;

    public function definition(): array
    {
        return [
            'input' => '1+1',
            'result' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
