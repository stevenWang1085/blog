<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:02
 */

namespace App\Http\Controllers\User;


class Transformer
{
    public function getCurrentUserTransform($result)
    {
        return [
            'id'    => $result['id'],
            'name'  => $result['name'],
            'email' => $result['email']
        ];
    }

}
