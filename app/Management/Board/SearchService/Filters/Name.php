<?php

namespace App\Management\Board\SearchService\Filters;

use App\Management\IFilter;
use Illuminate\Database\Eloquent\Builder;

class Name implements IFilter
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('name', $value);
    }
}
