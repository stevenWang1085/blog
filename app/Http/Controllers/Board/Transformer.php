<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:02
 */

namespace App\Http\Controllers\Board;

use Illuminate\Pagination;

class Transformer
{
    public function boardIndexTransformer($result, $per_page)
    {
        $data = [];

        foreach ($result as $key => $value) {
            $data[] = [
                'id' => $value['id'],
                'name' => $value['name']
            ];
        }

        return new Pagination\LengthAwarePaginator($data, $result->total(), $per_page);
    }
}
