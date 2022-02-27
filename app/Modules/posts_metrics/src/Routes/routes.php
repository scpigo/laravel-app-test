<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Modules\posts_metrics\src\Controllers\PostsMetricsController;

Route::group(['middleware' => ['json.response'], 'prefix' => 'metrics'], function($router) {
    Route::post('/search', [PostsMetricsController::class, 'search']);
});