<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calculator\CalculatorController;

/*
 * Calculator routes
 */
Route::post('/calculate', [CalculatorController::class, 'store']);
Route::get('/calculations', [CalculatorController::class, 'show']);
Route::delete('/calculations/{calculation}', [CalculatorController::class, 'delete']);
Route::delete('/calculations', [CalculatorController::class, 'destroy']);
