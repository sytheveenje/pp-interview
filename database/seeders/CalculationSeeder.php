<?php

namespace Database\Seeders;

use App\Models\Calculation;
use Illuminate\Database\Seeder;

class CalculationSeeder extends Seeder
{
    public function run(): void
    {
        Calculation::factory()->count(10)->create();
    }
}
