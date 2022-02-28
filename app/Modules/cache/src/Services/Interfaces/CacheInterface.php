<?php

namespace App\Modules\cache\src\Services\Interfaces;

interface CacheInterface {
    public function getValue(string $key);
    public function clearCache();
}