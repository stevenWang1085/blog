<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\ArticleCommentReply;

use App\Management\BaseService;

class Service extends BaseService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function store($data, $comment_id)
    {
        $insert_data = [
            'user_id'            => session()->get('user_id'),
            'article_comment_id' => $comment_id,
            'comment'            => $data['comment']
        ];

        return $this->repository->insert($insert_data);
    }
}
