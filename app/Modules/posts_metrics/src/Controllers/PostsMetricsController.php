<?php

namespace App\Modules\posts_metrics\src\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\posts_metrics\src\Requests\PostsMetricsSearchRequest;
use App\Modules\posts_metrics\src\Services\Interfaces\PostsMetricsInterface;

class PostsMetricsController extends Controller
{
    public function search(PostsMetricsSearchRequest $request)
    {
        $params = $request->validated();

        $service = app()->make(PostsMetricsInterface::class);
        $data = $service->search($params);
        
        return response()->json([
            'data' => [
                'count' => count($data),
                'items' => $data
            ],
            'statusText' => 'Метрики возвращены',
            'status' => 'ok'
        ], 201);
    }
}
