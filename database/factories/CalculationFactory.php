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
        // Generate a random mathematical expression
        $operators = ['+', '-', '*', '/'];
        $num1 = $this->faker->numberBetween(1, 100);
        $num2 = $this->faker->numberBetween(1, 100);
        $operator = $this->faker->randomElement($operators);

        $expression = "$num1 $operator $num2";

        // Safely evaluate the result
        $result = eval("return $expression;");

        return [
            'input' => $expression,
            'result' => $result,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
