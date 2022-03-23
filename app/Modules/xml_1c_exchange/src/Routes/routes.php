<?php

use App\Modules\xml_1c_exchange\src\Controllers\TestController;
use App\Modules\xml_1c_exchange\src\Controllers\XmlExchangeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['json.response'], 'prefix' => 'xml_exchange'], function($router) {
    Route::get('/upload', [XmlExchangeController::class, 'upload']);
    Route::post('/read', [XmlExchangeController::class, 'read']);

    Route::post('/test', [TestController::class, 'test']);
});