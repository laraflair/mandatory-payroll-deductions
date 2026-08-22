<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\StatutoryContributions;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\ArrayModel;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\StatutoryContributions;

class SSS extends ArrayModel
{
    use StatutoryContributions;

    protected static function dataFile(): string
    {
        return __DIR__ . '/../Data/SSS.php';
    }

    public function calculate(Money $amount): array
    {
        $compensation = $amount;

        $this->employer = Money::of(0, currency: 'PHP', roundingMode: RoundingMode::HalfUp);
        $this->employee = Money::of(0, currency: 'PHP', roundingMode: RoundingMode::HalfUp);
        $this->total = Money::of(0, currency: 'PHP', roundingMode: RoundingMode::HalfUp);

        if ($compensation->isZero()) {
            return $this->toArray();
        }

        $model = $this->rows()->where('range_of_compensation.from', '<=', $compensation->getAmount()->toFloat())
            ->where('range_of_compensation.to', '>=', $compensation->getAmount()->toFloat())
            ->first();

        $contribution = data_get($model, 'amount_of_contributions');

        $this->employer = $this->employer->plus(data_get($contribution, 'employer.total'), RoundingMode::HalfUp);

        $this->employee = $this->employee->plus(data_get($contribution, 'employee.total'), RoundingMode::HalfUp);

        $this->total = $this->total->plus($this->employee, RoundingMode::HalfUp)
            ->plus($this->employer, RoundingMode::HalfUp);

        return $this->toArray();
    }
}
