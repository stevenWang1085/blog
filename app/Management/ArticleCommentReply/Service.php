<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\ArticleCommentReply;

use App\Management\BaseService;
use App\Notifications\ArticleReply;
use Illuminate\Support\Facades\Notification;
use App\Management\ArticleComment\Repository as ArticleCommentRepository;
use App\Management\User\Repository as UserRepository;
use App\Management\Article\Repository as ArticleRepository;

class Service extends BaseService
{
    private $repository;
    private $articleCommentRepository;
    private $userRepository;
    private $articleRepository;

    public function __construct()
    {
        $this->repository = new Repository();
        $this->articleCommentRepository = new ArticleCommentRepository();
        $this->userRepository = new UserRepository();
        $this->articleRepository = new ArticleRepository();
    }

    public function store($data, $comment_id)
    {
        $insert_data = [
            'user_id'            => $this->user_id,
            'article_comment_id' => $comment_id,
            'comment'            => $data['comment']
        ];

        if ($this->repository->insert($insert_data)) {
            #更新留言總數
            $this->articleRepository->find($data['article_id'])->increment('comments', 1);
            #留言回覆通知
            $this->processNotify($comment_id);
            return true;
        }

        return false;
    }

    private function processNotify($comment_id)
    {
        $comment_data = $this->articleCommentRepository->find($comment_id, 'articleRelation');

        if ($this->user_id != $comment_data['user_id']) {
            $notify_user = $this->userRepository->find($comment_data['user_id']);
            $notify_user->increment('notification_count', 1);
            $notify_data = [
                'notify_from_user_id'   => $this->user_id,
                'notify_to_user_id'     => $comment_data['user_id'],
                'notify_type'           => 'article_comment_reply',
                'notify_from_user_name' => $this->user_name,
                'article_title'         => $comment_data->articleRelation['title'],
                'article_comment'       => $comment_data['comment'],
                'article_id'            => $comment_data['article_id'],
                'time'                  => date('Y-m-d H:i:s')
            ];
            Notification::send($notify_user, new ArticleReply($notify_data));
        }
    }
}
