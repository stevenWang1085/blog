<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\Board;

use App\Management\BaseService;

class Service extends BaseService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function store($request)
    {
        $data = [
            'name' => $request->name,
            'memo' => $request->memo,
            'edited_user_id' => session()->get('user_id', 1)
        ];
        $result = $this->repository->insert($data);
        if ($result === false) return false;

        return true;
    }

    public function update($request, $id)
    {
        $data = [
            'name' => $request->name,
            'memo' => $request->memo,
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
}
