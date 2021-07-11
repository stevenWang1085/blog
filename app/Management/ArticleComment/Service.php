<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\ArticleComment;

use App\Management\BaseService;
use App\Management\Article\Repository as ArticleRepository;
use App\Notifications\ArticleReply;
use Illuminate\Support\Facades\Notification;
use App\Management\User\Repository as UserRepository;

class Service extends BaseService
{
    private $repository;
    private $articleRepository;
    private $userRepository;

    public function __construct()
    {
        $this->repository = new Repository();
        $this->articleRepository = new ArticleRepository();
        $this->userRepository = new UserRepository();
    }

    public function store($request, $article_id)
    {
        $data = [
            'article_id' => $article_id,
            'user_id'    => $this->user_id,
            'comment'    => $request->comment
        ];

        #更新article總表留言數
        $article_data = $this->articleRepository->find($article_id);
        $this->articleRepository->updateWheres(['id' => $article_id], ['comments' => $article_data['comments'] +1]);
        #新增留言
        $insert_result = $this->repository->insert($data);
        if ($insert_result) {
            #處理回覆通知
            $this->processSendNotify($article_data);
            return  true;
        }

        return false;
    }

    private function processSendNotify($article_data)
    {
        $user = $this->userRepository->find($article_data['edited_user_id']);
        $notify_data = [
            'article_id'            => $article_data['id'],
            'article_title'         => $article_data['title'],
            'notify_from_user_id'   => $this->user_id,
            'notify_from_user_name' => $this->user_name,
            'notify_to_user_id'     => $user['id'],
            'notify_type'           => 'article_reply',
            'time'                  => date('Y-m-d H:i:s')
        ];
        if ($this->user_id != $article_data['edited_user_id']) {
            $user->increment('notification_count', 1);
            #文章回覆通知
            Notification::send($user, new ArticleReply($notify_data));
        }
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
