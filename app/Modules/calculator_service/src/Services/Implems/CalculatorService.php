<?php

namespace App\Modules\calculator_service\src\Services\Implems;

use App\Modules\calculator_service\src\Services\Interfaces\CalculatorInterface;

class CalculatorService implements CalculatorInterface
{
    public function calculate($operation, int $a, int $b) {
        if ($operation == '+') return $this->sum($a, $b);
        if ($operation == '-') return $this->subtraction($a, $b);
        if ($operation == '*') return $this->multiplication($a, $b);
        if ($operation == '/') return $this->division($a, $b);
    }

    public function sum(int $a, int $b): int {
        return $a + $b;
    }

    public function subtraction(int $a, int $b): int {
        return $a - $b;
    }

    public function multiplication(int $a, int $b): int {
        return $a * $b;
    }

    public function division(int $a, int $b): float {
        return $a/$b;
    }

}
