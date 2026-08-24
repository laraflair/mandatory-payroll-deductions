<?php

use Brick\Math\RoundingMode;
use Brick\Money\Money;
use Laraflair\MandatoryPayrollDeductions\PH\StatutoryContributions\PagIbig;

it('calculate PagIbig with basic salary of 40,000', function () {
    $amount = Money::of(40_000, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PagIbig()->calculate($amount);

    expect($result)
        ->toMatchArray([
            "employer" => 200,
            "employee" => 200,
            "total" => 400
        ]);
});

it('calculate PagIbig with basic salary of  74,343', function () {
    $amount = Money::of(74_343, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PagIbig()->calculate($amount);

    expect($result)
        ->toMatchArray([
            "employer" => 200,
            "employee" => 200,
            "total" => 400
        ]);
});

it('calculate PagIbig with basic salary of  23,000', function () {
    $amount = Money::of(23_000, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PagIbig()->calculate($amount);

    expect($result)
        ->toMatchArray([
            "employer" => 200,
            "employee" => 200,
            "total" => 400
        ]);
});

it('calculate PagIbig with basic salary of 8,500', function () {
    $amount = Money::of(8_500, 'PHP', roundingMode: RoundingMode::HalfUp);

    $result = new PagIbig()->calculate($amount);

    expect($result)
        ->toMatchArray([
            "employer" => 170,
            "employee" => 170,
            "total" => 340
        ]);
});
