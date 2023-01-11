<?php

namespace App\ProductSearch\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;

class Hasdiscount implements Filter
{

    /**
     * Apply a given search value to the builder instance.
     *
     * @param Builder $builder
     * @param mixed $value
     * @return Builder $builder
     */
    public static function apply(Builder $builder, $value)
    {
        if ($value == 'none') {
            return $builder;
        }
        return $builder->where('hasDiscount',  $value == 'true' ? true : false);
    }
}
