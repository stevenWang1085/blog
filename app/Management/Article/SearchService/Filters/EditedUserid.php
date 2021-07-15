<?php

namespace App\Management\Article\SearchService\Filters;

use App\Management\IFilter;
use Illuminate\Database\Eloquent\Builder;

class EditedUserid implements IFilter
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('edited_user_id', $value);
    }
}
