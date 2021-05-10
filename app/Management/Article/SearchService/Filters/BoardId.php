<?php

namespace App\Management\Article\SearchService\Filters;

use App\Management\IFilter;
use Illuminate\Database\Eloquent\Builder;

class BoardId implements IFilter
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('board_id', $value);
    }
}
