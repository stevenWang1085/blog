<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\Article\SearchService;

use App\Management\BaseSearchService;
use App\Management\Article\Entity;

class Search extends BaseSearchService
{
    public static  function apply($filters, $type = 'page')
    {
        $order = [];
        foreach ($filters as $key => $val) {
            if (empty($val) || $val == '' || $val == null || $val == 'all' || $key == 'order_column' || $key == 'order_column_by') {
                $order[$key] = $val;
                unset($filters[$key]);
            }
        }

        $query = BaseSearchService::applyDecoratorsFromRequest($filters, (new Entity)
            ->with(['userRelation', 'articleFavorRelation'])
            ->orderBy($order['order_column'], $order['order_column_by'])
            ->newQuery(), 'Filters', __NAMESPACE__);

        if ($type == 'page') {
            return BaseSearchService::getResultsWithPaginate($query, $filters['per_page']);
        } else {
            return BaseSearchService::getResultsWithGet($query);
        }
    }
}
