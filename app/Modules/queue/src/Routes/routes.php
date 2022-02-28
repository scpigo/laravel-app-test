<?php

use App\Modules\queue\src\Controllers\QueueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['json.response'], 'prefix' => 'queue'], function($router) {
    Route::post('/send', [QueueController::class, 'send']);
});