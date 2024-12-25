<?php

namespace App\Providers;

use App\Contracts\CalculatorInterface;
use App\Services\Calculator\CalculateService;
use Illuminate\Support\ServiceProvider;
use NXP\MathExecutor;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            CalculatorInterface::class, function($app) {
                return new CalculateService(new MathExecutor());
            }
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
