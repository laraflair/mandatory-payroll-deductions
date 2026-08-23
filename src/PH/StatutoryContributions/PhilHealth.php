<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\StatutoryContributions;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Illuminate\Support\Carbon;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\ArrayModel;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\StatutoryContributions;

class PhilHealth extends ArrayModel
{
    use StatutoryContributions;

    protected static function dataFile(): string
    {
        return __DIR__ . '/../Data/PhilHealth.php';
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

        $model = $this->rows()
            ->where('year', Carbon::now('Asia/Manila')->year)
            ->where('monthly_basic_salary.from', '<=', $compensation->getAmount()->toFloat())
            ->where('monthly_basic_salary.to', '>=', $compensation->getAmount()->toFloat())
            ->first();

        $monthlyPremium = data_get($model, 'monthly_premium');

        $premiumRate = (string) data_get($model, 'premium_rate', 0);
        $minMoney = Money::of(data_get($monthlyPremium, 'minimum'), 'PHP', roundingMode: RoundingMode::HalfUp);
        $maxMoney = Money::of(data_get($monthlyPremium, 'maximum'), 'PHP', roundingMode: RoundingMode::HalfUp);

        $rawTotal = $compensation->multipliedBy($premiumRate, RoundingMode::HalfUp);

        if ($rawTotal->isLessThan($minMoney)) {
            $monthlyTotal = $minMoney;
        } elseif ($rawTotal->isGreaterThan($maxMoney)) {
            $monthlyTotal = $maxMoney;
        } else {
            $monthlyTotal = $rawTotal;
        }

        $half = $monthlyTotal->dividedBy(2, RoundingMode::HalfUp);

        $this->employer = $half;

        $this->employee = $half;

        $this->total = $monthlyTotal;

        return $this->toArray();
    }
}
