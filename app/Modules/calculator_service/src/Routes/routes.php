<?php

use App\Modules\calculator_service\src\Controllers\CalculatorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['json.response'], 'prefix' => 'calculator'], function($router) {
    Route::post('/execute', [CalculatorController::class, 'execute']);
});