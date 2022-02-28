<?php

namespace App\Modules\posts_metrics\src\Services\Implems;

use App\Modules\posts_metrics\src\Services\Interfaces\PostsMetricsInterface;
use App\Modules\posts_metrics\src\Models\PostsMetric;
use Illuminate\Support\Arr;

class PostsMetricsMongoService implements PostsMetricsInterface {
    public function search(array $params) {
        //PostsMetric::filter()
        $data = PostsMetric::where('group_type', Arr::get($params, 'group_type'))
            ->orderBy(Arr::get($params, 'sort'), Arr::get($params, 'sortType'))
            ->paginate(10, ['*'], 'page');

        return $data;
    }
}