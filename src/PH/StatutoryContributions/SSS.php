<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\StatutoryContributions;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\ArrayModel;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\StatutoryContributions;

class SSS extends StatutoryContributions
{
    use ArrayModel;

    protected static function dataFile(): string
    {
        return __DIR__ . '/../Data/SSS.php';
    }

    public function calculate(Money $amount): array
    {
        $compensation = $amount;

        if ($compensation->isZero()) {
            return $this->toArray();
        }

        $model = $this->rows()->where('range_of_compensation.from', '<=', $compensation->getAmount()->toFloat())
            ->where('range_of_compensation.to', '>=', $compensation->getAmount()->toFloat())
            ->first();

        $contribution = data_get($model, 'amount_of_contributions');

        $this->setEmployee(
            $this->getEmployee()->plus(data_get($contribution, 'employee.total'), RoundingMode::HalfUp)
        );

        $this->setEmployer(
            $this->getEmployer()->plus(data_get($contribution, 'employer.total'), RoundingMode::HalfUp)
        );

        $this->setTotal(
            $this->getTotal()
                ->plus($this->getEmployee(), RoundingMode::HalfUp)
                ->plus($this->getEmployer(), RoundingMode::HalfUp)
        );

        return $this->toArray();
    }
}
