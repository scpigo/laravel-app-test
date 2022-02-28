<?php

namespace App\Modules\cache\src\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CacheController extends Controller
{
    public function getValue(Request $request) {
        $data = app('CacheManager')->getValue($request->input('key', 'kluch'));

        return response()->json([
            'data' => $data,
            'statusText' => 'Ключ возвращен',
            'status' => 'ok'
        ], 201);
    }

    public function clearCache() {
        app('CacheManager')->clearCache();

        return response()->json([
            'data' => [],
            'statusText' => 'Кэш отчистен',
            'status' => 'ok'
        ], 201);
    }
}
