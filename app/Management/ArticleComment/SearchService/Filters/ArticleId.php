<?php

namespace App\Management\ArticleComment\SearchService\Filters;

use App\Management\IFilter;
use Illuminate\Database\Eloquent\Builder;

class ArticleId implements IFilter
{
    public static function apply(Builder $builder, $value)
    {
        return $builder->where('article_id', $value);
    }
}
