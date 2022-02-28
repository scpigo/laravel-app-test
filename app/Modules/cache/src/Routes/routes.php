<?php

use App\Modules\cache\src\Controllers\CacheController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['json.response'], 'prefix' => 'cache'], function($router) {
    Route::post('/getvalue', [CacheController::class, 'getValue']);
    Route::post('/clearcache', [CacheController::class, 'clearCache']);
});