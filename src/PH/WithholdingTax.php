<?php

namespace Laraflair\MandatoryPayrollDeductions\PH;

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\ArrayModel;
use Laraflair\MandatoryPayrollDeductions\PH\Enums\WithholdingTaxFrequency;

class WithholdingTax
{
    use ArrayModel;
    private Money $total;

    protected static function dataFile(): string
    {
        return __DIR__ . '/Data/WithholdingTax.php';
    }

    public function calculate(Money $amount, WithholdingTaxFrequency $frequency = WithholdingTaxFrequency::Monthly): array
    {
        $this->total = Money::of(0, currency: 'PHP', roundingMode: RoundingMode::HalfUp);

        if ($amount->isZero()) {
            return $this->toArray();
        }

        $model = $this->rows()
            ->where('compensation_range.from', '<=', $amount->getAmount()->toFloat())
            ->where('compensation_range.to', '>=', $amount->getAmount()->toFloat())
            ->where('frequency', $frequency->value)
            ->first();

        $over = (string) data_get($model, 'prescribe_withholding_tax.over', 0);
        $rate = (string) data_get($model, 'prescribe_withholding_tax.rate', 0);
        $fix = (string) data_get($model, 'prescribe_withholding_tax.fix', 0);

        $this->total = $amount->minus(Money::of($over, 'PHP', roundingMode: RoundingMode::HalfUp))
            ->multipliedBy($rate, RoundingMode::HalfUp)
            ->plus(Money::of($fix, 'PHP', roundingMode: RoundingMode::HalfUp));

        return $this->toArray();
    }

    protected function toArray(): array
    {
        return [
            'total' => $this->total->getAmount()->toFloat(),
        ];
    }
}
