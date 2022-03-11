<?php

use App\Modules\system_job\src\Controllers\SystemJobController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['json.response'], 'prefix' => 'system_job_package'], function($router) {
    Route::post('/schedule', [SystemJobController::class, 'schedule']);
    Route::post('/find', [SystemJobController::class, 'find']);
});