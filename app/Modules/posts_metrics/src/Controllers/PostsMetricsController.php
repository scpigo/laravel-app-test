<?php

namespace App\Modules\posts_metrics\src\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\posts_metrics\src\Models\PostsMetric;
use App\Modules\posts_metrics\src\Requests\PostsMetricsSearchRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PostsMetricsController extends Controller
{
    public function search(PostsMetricsSearchRequest $request)
    {
        $params = $request->validated();

        $data = PostsMetric::where('group_type', Arr::get($params, 'group_type'))
            ->orderBy(Arr::get($params, 'sort'), Arr::get($params, 'sortType'))
            ->paginate(10, ['*'], 'page');
        
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
