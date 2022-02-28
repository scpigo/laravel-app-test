<?php

namespace App\Modules\posts_metrics\src\Services\Implems;

use App\Modules\posts_metrics\src\Services\Interfaces\PostsMetricsInterface;
use App\Modules\posts_metrics\src\Models\PostsMetric;
use Illuminate\Support\Arr;

class PostsMetricsMongoService implements PostsMetricsInterface {
    public function search(array $params) {
        $data = null;

        if (Arr::get($params, 'group_type') !== null) {
            $data = PostsMetric::where('group_type', Arr::get($params, 'group_type'))
                ->orderBy(Arr::get($params, 'sort'), Arr::get($params, 'sortType'))
                ->paginate(Arr::get($params, 'pageSize'), ['*'], 'page');
        } else {
            $data = PostsMetric::orderBy(Arr::get($params, 'sort'), Arr::get($params, 'sortType'))
                ->paginate(Arr::get($params, 'pageSize'), ['*'], 'page');
        }

        return $data;
    }
}