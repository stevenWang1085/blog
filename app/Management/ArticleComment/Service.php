<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\ArticleComment;

use App\Management\BaseService;

class Service extends BaseService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function store($request, $article_id)
    {
        $data = [
            'article_id' => $article_id,
            'user_id'    => $this->user_id,
            'comment'    => $request->comment
        ];

        return $this->repository->insert($data);
    }

    public function update($request, $comment_id)
    {
        $where = [
            'id' => $comment_id
        ];

        $data = [
            'comment' => $request->comment
        ];

        return $this->repository->updateWheres($where, $data);
    }

    public function delete($comment_id)
    {
        return $this->repository->delete(['id' => $comment_id]);
    }
}
