<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\Concerns;

use Brick\Money\Money;

trait StatutoryContributions
{
    private Money $employer;

    private Money $employee;

    private Money $total;

    protected function toArray(): array
    {
        return [
            'employer' => $this->employer->getAmount()->toFloat(),
            'employee' => $this->employee->getAmount()->toFloat(),
            'total' => $this->total->getAmount()->toFloat(),
        ];
    }
}
