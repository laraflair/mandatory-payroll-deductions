<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\Concerns;

use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
use Brick\Money\Money;

class StatutoryContributions
{
    private Money $employer;

    private Money $employee;

    private Money $total;

    public function __construct(
        Money|BigDecimal|int|string $employee = 0,
        Money|BigDecimal|int|string $employer = 0,
        Money|BigDecimal|int|string $total = 0,
    ) {
        $this->setEmployee($employee);
        $this->setEmployer($employer);
        $this->setTotal($total);
    }

    public function setEmployer(Money|BigDecimal|int|string $amount)
    {
        if ($amount instanceof Money) {
            $this->employer = $amount;
            return;
        }
        $this->employer = Money::of($amount, 'PHP', roundingMode: RoundingMode::HalfUp);
    }

    public function getEmployer()
    {
        return $this->employer;
    }

    public function setEmployee(Money|BigDecimal|int|string $amount)
    {
        if ($amount instanceof Money) {
            $this->employee = $amount;
            return;
        }
        $this->employee = Money::of($amount, 'PHP', roundingMode: RoundingMode::HalfUp);
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function setTotal(Money|BigDecimal|int|string $amount)
    {
        if ($amount instanceof Money) {
            $this->total = $amount;
            return;
        }

        $this->total = Money::of($amount, 'PHP', roundingMode: RoundingMode::HalfUp);
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function toArray(): array
    {
        return [
            'employer' => $this->employer->getAmount()->toFloat(),
            'employee' => $this->employee->getAmount()->toFloat(),
            'total' => $this->total->getAmount()->toFloat(),
        ];
    }
}
