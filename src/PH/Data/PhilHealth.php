<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\Data;

return [
    [
        "year" => 2026,
        "monthly_basic_salary" => [
            "from" => 0,
            "to" => 10000
        ],
        "premium_rate" => 0.05,
        "monthly_premium" => [
            "minimum" => 500,
            "maximum" => 500
        ],
    ],
    [
        "year" => 2026,
        "monthly_basic_salary" => [
            "from" => 10000.01,
            "to" => 99999.99
        ],
        "premium_rate" => 0.05,
        "monthly_premium" => [
            "minimum" => 500,
            "maximum" => 5000
        ],
    ],
    [
        "year" => 2026,
        "monthly_basic_salary" => [
            "from" => 100000,
            "to" => 999999999999999
        ],
        "premium_rate" => 0.05,
        "monthly_premium" => [
            "minimum" => 5000,
            "maximum" => 5000
        ],
    ]
];
