<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\Article;

use App\Management\BaseService;
use App\Management\ArticleFavor\Repository as ArticleFavorRepository;
use App\Notifications\ArticleReply;
use Illuminate\Support\Facades\Notification;
use App\Management\User\Repository as UserRepository;

class Service extends BaseService
{
    private $repository;
    private $articleFavorRepository;
    private $userRepository;

    public function __construct()
    {
        $this->repository = new Repository();
        $this->articleFavorRepository = new ArticleFavorRepository();
        $this->userRepository = new UserRepository();
    }

    public function store($request)
    {
        $data = [
            'board_id'       => $request->board_id,
            'title'          => $request->title,
            'content'        => $request->content,
            'edited_user_id' => session()->get('user_id', 1)
        ];
        $result = $this->repository->insert($data);
        if ($result === false) return false;

        return true;
    }

    public function update($request, $id)
    {
        $data = [
            'title'          => $request->title,
            'content'        => $request->content,
            'edited_user_id' => session()->get('user_id', 1)
        ];
        $result = $this->repository->updateWheres(['id' => $id], $data);
        if ($result === false) return false;

        return true;
    }

    public function delete($id)
    {
        #刪除文章
        $result = $this->repository->find($id)->delete();
        if ($result === false) return false;

        return true;
    }

    public function updateFavor($id)
    {
        #搜尋user是否對此文章按過讚
        $favor_data = [
            'article_id' => $id,
            'user_id' => session()->get('user_id', 1)
        ];
        $favor_check = $this->articleFavorRepository->first($favor_data);
        $article_data = $this->repository->lockForUpdate($id);
        if ($favor_check === null) {
            #沒按過讚，新增一筆資料，並在article表中的favor總值+1
            $this->articleFavorRepository->insert($favor_data);
            $where = ['id' => $id];
            $update_data = ['favor' => $article_data['favor'] +1];
            $this->repository->updateWheres($where, $update_data);
            #按讚通知
            $this->processNotify($article_data);
        } else {
            #按過讚，刪除該按讚資料，並在article表中的favor總值-1
            $this->articleFavorRepository->delete($favor_data);
            $where = ['id' => $id];
            $update_data = ['favor' => $article_data['favor'] -1];
            $this->repository->updateWheres($where, $update_data);
        }
    }

    private function processNotify($article_data)
    {
        if ($this->user_id != $article_data['edited_user_id']) {
            $notify_user = $this->userRepository->find($article_data['edited_user_id']);
            $notify_user->increment('notification_count', 1);
            $notify_data = [
                'notify_from_user_id'   => $this->user_id,
                'notify_to_user_id'     => $notify_user['id'],
                'notify_from_user_name' => $this->user_name,
                'article_title'         => $article_data['title'],
                'notify_type'           => 'favor',
                'article_id'            => $article_data['id'],
                'time'                  => date('Y-m-d H:i:s')
            ];
            Notification::send($notify_user, new ArticleReply($notify_data));
        }
    }

    public function showOneArticle($id)
    {
        return $this->repository->getOneWithRelation($id, ['userRelation', 'articleFavorRelation', 'boardRelation']);
    }

}
