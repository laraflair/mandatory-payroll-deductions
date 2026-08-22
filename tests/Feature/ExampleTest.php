<?php

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\StatutoryContributions\SSS;

test('calculate SSS with taxable gross pay 40,000', function () {
    $amount = Money::of(40000, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 3530,
            "employee" => 1750,
            "total" => 5280
        ]);
});

test('calculate SSS with taxable gross pay 74,343', function () {
    $amount = Money::of(74_343, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 3530,
            "employee" => 1750,
            "total" => 5280
        ]);
});

test('calculate SSS with taxable gross pay 10,500', function () {
    $amount = Money::of(10_500, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 1060,
            "employee" => 525,
            "total" => 1585
        ]);
});

test('calculate SSS with taxable gross pay 8,500', function () {
    $amount = Money::of(8_500, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new SSS()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 860,
            "employee" => 425,
            "total" => 1285
        ]);
});