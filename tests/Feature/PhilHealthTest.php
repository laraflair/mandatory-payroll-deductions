<?php

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\StatutoryContributions\PhilHealth;

it('calculate PhilHealth with basic salary of 40,000', function () {
    $amount = Money::of(40_000, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PhilHealth()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 1000,
            "employee" => 1000,
            "total" => 2000
        ]);
});

it('calculate PhilHealth with basic salary of 74,343', function () {
    $amount = Money::of(74_343, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PhilHealth()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 1858.58,
            "employee" => 1858.58,
            "total" => 3717.15
        ]);
});

it('calculate PhilHealth with basic salary of 23,000', function () {
    $amount = Money::of(23_000, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PhilHealth()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 575,
            "employee" => 575,
            "total" => 1150
        ]);
});

it('calculate PhilHealth with basic salary of 8,500', function () {
    $amount = Money::of(8_500, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PhilHealth()->calculate($amount);


    expect($result)
        ->toMatchArray([
            "employer" => 250,
            "employee" => 250,
            "total" => 500
        ]);
});
