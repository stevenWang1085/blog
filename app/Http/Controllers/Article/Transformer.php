<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:02
 */

namespace App\Http\Controllers\Article;

use Illuminate\Pagination;

class Transformer
{
    public function articleIndexTransform($result, $per_page)
    {
        $data = [];
        foreach ($result as $key => $value) {
            $data[] = [
                'id'         => $value['id'],
                'title'      => $value['title'],
                'content'    => $value['content'],
                'favor'      => $value['favor'],
                'comments'   => $value['comments'],
                'created_at' => date('Y-m-d H:i:s', strtotime($value['created_at'])),
                'user_id'    => $value->userRelation['id'],
                'username'   => $value->userRelation['name']
            ];
        }

        return new Pagination\LengthAwarePaginator($data, $result->total(), $per_page);
    }

    public function articleShowTransform($result)
    {
        return [
            'id'            => $result['id'],
            'board_id'      => $result['board_id'],
            'title'         => $result['title'],
            'content'       => $result['content'],
            'favor'         => $result['favor'],
            'comments'      => $result['comments'],
            'user_id'       => $result->userRelation['id'],
            'username'      => $result->userRelation['name'],
            'created_at'    => date('Y-m-d H:i:s', strtotime($result['created_at'])),
            'current_favor' => $this->checkUserHaveFavor($result->articleFavorRelation)
        ];
    }

    private function checkUserHaveFavor($favor_user)
    {
        $check = false;
        foreach ($favor_user as $value) {
            if ($value['user_id'] === session()->get('user_id')) $check = true;
        }

        return $check;
    }
}
