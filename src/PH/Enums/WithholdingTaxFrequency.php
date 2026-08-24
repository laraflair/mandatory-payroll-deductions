<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\Enums;

enum WithholdingTaxFrequency: int
{
    case SemiMonthly = 1;
    case Monthly = 2;
}
