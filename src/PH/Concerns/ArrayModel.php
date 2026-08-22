<?php

namespace Laraflair\MandatoryPayrollDeductions\PH\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\LazyCollection;

abstract class ArrayModel
{
    protected array $wheres = [];

    /**
     * Return the fully-qualified path to the data file for this model.
     */
    abstract protected static function dataFile(): string;

    /**
     * Lazily yield rows from the data file without loading
     * the whole array into a "hydrated" state up front.
     */
    protected function rows(): LazyCollection
    {
        return LazyCollection::make(function () {
            foreach (require static::dataFile() as $row) {
                yield $row;
            }
        });
    }
}