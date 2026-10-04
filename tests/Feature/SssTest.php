<?php

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\Concerns\StatutoryContributions;
use Laraflair\MandatoryPayrollDeductions\PH\StatutoryContributions\SSS;

it('calculate SSS with taxable gross pay 40,000', function () {
    $amount = Money::of(40000, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 3530,
            "employee" => 1750,
            "total" => 5280
        ]);
});

it('calculate SSS with taxable gross pay 74,343', function () {
    $amount = Money::of(74_343, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 3530,
            "employee" => 1750,
            "total" => 5280
        ]);
});

it('calculate SSS with taxable gross pay 10,500', function () {
    $amount = Money::of(10_500, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 1060,
            "employee" => 525,
            "total" => 1585
        ]);
});

it('calculate SSS with taxable gross pay 8,500', function () {
    $amount = Money::of(8_500, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 860,
            "employee" => 425,
            "total" => 1285
        ]);
});


it('calculate SSS with taxable gross pay 32,945.02', function () {
    $amount = Money::of((string) 16479.32, 'PHP', roundingMode: RoundingMode::HalfUp);

    $firstSemiMonthly = new SSS()->calculate($amount);

    expect($firstSemiMonthly)
        ->toMatchArray([
           "employee" => 825,
            "employer" => 1680,
            "total" => 2505
        ]);
                            

    $secondAmount = Money::of((string) 16465.7, 'PHP', roundingMode: RoundingMode::HalfUp);
    
    $final = new SSS()->calculate(
        $secondAmount->plus($amount, RoundingMode::HalfUp),
        new StatutoryContributions(
            (string) data_get($firstSemiMonthly, 'employee', 0),
            (string) data_get($firstSemiMonthly, 'employer', 0),
            (string) data_get($firstSemiMonthly, 'total', 0)
        )
    );

    expect($final)
        ->toMatchArray([
            "employer" => 1650,
            "employee" => 825,
            "total" => 2475
        ]);
});