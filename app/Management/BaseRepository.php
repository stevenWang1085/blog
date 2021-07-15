<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/20
 * Time: 上午8:48
 */

namespace App\Management;


abstract class BaseRepository
{
    public function create($data)
    {
        return $this->query()->create($data);
    }

    public function insert($data)
    {
        return $this->query()->insert($data);
    }

    public function updateOrCreate($search_data, $update_data)
    {
        return $this->query()->updateOrCreate($search_data, $update_data);
    }

    public function getAll($where_data, $where_in_data = [])
    {
        return $this->query()->where(function ($query) use ($where_data, $where_in_data) {
            foreach ($where_data as $key => $value) {
                $query->where($key, $value);
            }
            foreach ($where_in_data as $key => $value) {
                $query->whereIn($key, $value);
            }
        })->get();
    }

    public function find($id, $relations = null)
    {
        if (is_null($relations)) {
            return $this->query()->findOrFail($id);
        }

        return $this->query()->with($relations)->findOrFail($id);
    }

    public function lockForUpdate($id)
    {
        return $this->query()->lockForUpdate()->findOrFail($id);
    }

    public function get($validator_data = null)
    {
        if ($validator_data == null) {
            return $this->query()->get();
        } else {
            return $this->query()->where(function ($query) use ($validator_data) {
                foreach ($validator_data as $key => $value) {
                    $query->where($key, $value);
                }
            })->get();
        }
    }

    public function first($validator_data)
    {
        return $this->query()->where(function ($query) use ($validator_data) {
            foreach ($validator_data as $key => $value) {
                $query->where($key, $value);
            }
        })->first();
    }

    private function query()
    {
        return call_user_func(static::MODEL . '::query');
    }

    public function updateWheres($where_data, $update_data)
    {
        return $this->query()->where($where_data)->update($update_data);
    }

    /**
     * @param $where
     * @param $data
     * @return mixed
     */
    public function delete($where)
    {
        return $this->query()->where($where)->delete();
    }

}
