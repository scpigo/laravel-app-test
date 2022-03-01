<?php

namespace App\Modules\calculator_service\src\Services\Interfaces;

interface CalculatorInterface {
    public function sum(int $a, int $b): int;
    public function subtraction(int $a, int $b): int;
    public function multiplication(int $a, int $b): int;
    public function division(int $a, int $b): float;
}
