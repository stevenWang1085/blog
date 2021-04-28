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

class Service extends BaseService
{
    private $repository;
    private $articleFavorRepository;

    public function __construct()
    {
        $this->repository = new Repository();
        $this->articleFavorRepository = new ArticleFavorRepository();
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
        $result = $this->repository->delete(['id' => $id]);
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
        } else {
            #按過讚，刪除該按讚資料，並在article表中的favor總值-1
            $this->articleFavorRepository->delete($favor_data);
            $where = ['id' => $id];
            $update_data = ['favor' => $article_data['favor'] -1];
            $this->repository->updateWheres($where, $update_data);
        }
    }

}
