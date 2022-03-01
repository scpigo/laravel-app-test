<?php

use App\Modules\system_job\src\Controllers\JobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['json.response'], 'prefix' => 'system_job'], function($router) {
    Route::post('/add', [JobController::class, 'add']);
    Route::post('/find', [JobController::class, 'find']);
});