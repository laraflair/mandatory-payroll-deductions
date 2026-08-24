<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\Data;

return [
    [
        "year" => 2026,
        "monthly_basic_salary" => [
            "from" => 0,
            "to" => 10000
        ],
        "premium_rate" => 0.02,
        "monthly_premium" => [
            "minimum" => 0,
            "maximum" => 200
        ],
    ],
    [
        "year" => 2026,
        "monthly_basic_salary" => [
            "from" => 10_001,
            "to" => 999999999999999
        ],
        "premium_rate" => 0.02,
        "monthly_premium" => [
            "minimum" => 200,
            "maximum" => 200
        ],
    ]
];
