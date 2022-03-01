<?php

namespace App\Modules\calculator_service\src\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\calculator_service\src\Requests\CalculatorRequest;
use App\Modules\calculator_service\src\Services\Interfaces\CalculatorInterface;
use Illuminate\Support\Arr;

class CalculatorController extends Controller
{
    public function execute(CalculatorRequest $request) {
        $params = $request->validated();

        $calculator = app()->make(CalculatorInterface::class);
        $result = $calculator->calculate(Arr::get($params, 'operation'), Arr::get($params, 'a'), Arr::get($params, 'b'));

        return response()->json([
            'data' => [
                'result' => $result
            ],
            'statusText' => 'Результат получен',
            'status' => 'ok'
        ], 201);
    }
}
