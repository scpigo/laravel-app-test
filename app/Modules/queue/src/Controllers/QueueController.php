<?php

namespace App\Modules\queue\src\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\queue\src\Jobs\WriteJob;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QueueController extends Controller
{
    public function send() {
        WriteJob::dispatch(base_path().'/rabbitmq_test.txt', Str::random(16)."\n")->onConnection('rabbitmq_microservice');

        return response()->json([
            'data' => [],
            'statusText' => 'Задача поставлена в очередь',
            'status' => 'ok'
        ], 201);
    }
}
