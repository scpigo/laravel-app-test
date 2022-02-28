<?php

namespace App\Modules\cache\src\Services\Implems;

use App\Modules\cache\src\Models\SystemSetting;
use App\Modules\cache\src\Services\Interfaces\CacheInterface;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Arr;

class CacheRedisService implements CacheInterface {
    private const CACHE_KEY = 'system_settings';

    public function getValue(string $key)
    {
        $cache = Redis::get(self::CACHE_KEY);
        $cache = json_decode($cache, true);

        if ($value = Arr::get($cache, $key)) {
            return $value;
        }

        $options = SystemSetting::all();

        $options = collect($options)->mapWithKeys(function ($item, $key) {
            return [
                $item['key'] => $item['value']
            ];
        });

        Redis::set(self::CACHE_KEY, json_encode($options), 'EX', 60*60);

        return Arr::get($options, $key);
    }

    public function clearCache()
    {
        Redis::del(self::CACHE_KEY);
    }
}