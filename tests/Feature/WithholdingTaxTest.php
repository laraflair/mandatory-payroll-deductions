<?php

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\WithholdingTax;

describe('bracket 6', function () {
    it('calculate withholding tax with taxable income of 795,550', function () {
        $amount = Money::of(795_550, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 228_650.85
            ]);
    });
});

describe('bracket 5', function () {
    it('calculate withholding tax with taxable income of 195,550', function () {
        $amount = Money::of(195_550, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 42_206.70
            ]);
    });
});

describe('bracket 4', function () {
    it('calculate withholding tax with taxable income of 115,550', function () {
        $amount = Money::of(115_550, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 20_762.55
            ]);
    });


    it('calculate withholding tax with taxable income of 85,800', function () {
        $amount = Money::of(85_800, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 13_325.05
            ]);
    });
});

describe('bracket 3', function () {
    it('calculate withholding tax with taxable income of 66,300', function () {
        $amount = Money::of(66_300.00, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 8_468.40
            ]);
    });
});


describe('bracket 2', function () {
    it('calculate withholding tax with taxable income of 27,550', function () {
        $amount = Money::of(27_550, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 1_007.55
            ]);
    });


    it('calculate withholding tax with taxable income of 22,925', function () {
        $amount = Money::of(22_925, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 313.80
            ]);
    });
});


describe('bracket 1', function () {
    it('calculate withholding tax with taxable income of 8,500', function () {
        $amount = Money::of(8_500, 'PHP', roundingMode: RoundingMode::HalfUp);

        $result = new WithholdingTax()->calculate($amount);


        expect($result)
            ->toMatchArray([
                "total" => 0
            ]);
    });
});
