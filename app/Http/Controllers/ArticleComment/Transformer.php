<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:02
 */

namespace App\Http\Controllers\ArticleComment;

use Illuminate\Pagination;

class Transformer
{
    public function articleCommentIndexTransform($result, $per_page)
    {
        $data = [];

        foreach ($result as $key => $value) {
            $reply = [];
            foreach ($value->articleReplyCommentRelation as $reply_value) {
                $reply[] = [
                    'comment'    => $reply_value['comment'],
                    'username'   => $reply_value->userRelation['name'],
                    'updated_at' => date('Y-m-d H:i:s', strtotime($reply_value['updated_at'])),
                ];
            }

            $data[] = [
                'id'         => $value['id'],
                'comment'    => $value['comment'],
                'username'   => $value->userRelation['name'],
                'updated_at' => date('Y-m-d H:i:s', strtotime($value['updated_at'])),
                'reply_comment' => $reply
            ];
        }

        return new Pagination\LengthAwarePaginator($data, $result->total(), $per_page);
    }

}
