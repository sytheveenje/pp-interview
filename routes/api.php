<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Calculator\CalculatorController;

Route::post('/calculate', [CalculatorController::class, 'calculate']);
Route::get('/history', [CalculatorController::class, 'history']);
