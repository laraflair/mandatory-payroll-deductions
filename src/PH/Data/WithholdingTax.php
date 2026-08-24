<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\Data;

return [
    [
        "compensation_range" => [
            "from" => 0,
            "to" => 20832
        ],
        "prescribe_withholding_tax" => [
            "fix" => 0,
            "rate" => 0,
            "over" => 0
        ],
        "frequency" => 2,
        "effective_at" => "2026-01-01",
    ],
    [
        "compensation_range" => [
            "from" => 20833,
            "to" => 33332
        ],
        "prescribe_withholding_tax" => [
            "fix" => 0,
            "rate" => 0.15,
            "over" => 20833
        ],
        "frequency" => 2,
        "effective_at" => "2026-01-01",
    ],
    [
        "compensation_range" => [
            "from" => 33333,
            "to" => 66666
        ],
        "prescribe_withholding_tax" => [
            "fix" => 1875,
            "rate" => 0.2,
            "over" => 33333
        ],
        "frequency" => 2,
        "effective_at" => "2026-01-01",

    ],
    [
        "compensation_range" => [
            "from" => 66667,
            "to" => 166666
        ],
        "prescribe_withholding_tax" => [
            "fix" => 8541.8,
            "rate" => 0.25,
            "over" => 66667
        ],
        "frequency" => 2,
        "effective_at" => "2026-01-01",
    ],
    [
        "compensation_range" => [
            "from" => 166667,
            "to" => 666666
        ],
        "prescribe_withholding_tax" => [
            "fix" => 33541.8,
            "rate" => 0.3,
            "over" => 166667
        ],
        "frequency" => 2,
        "effective_at" => "2026-01-01",
    ],
    [
        "compensation_range" => [
            "from" => 666667,
            "to" => 9999999999
        ],
        "prescribe_withholding_tax" => [
            "fix" => 183541.8,
            "rate" => 0.35,
            "over" => 666667
        ],
        "frequency" => 2,
        "effective_at" => "2026-01-01",
    ]
];
