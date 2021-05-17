<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\User;

use App\Management\BaseRepository;

class Repository extends BaseRepository
{
    private $entity;

    const MODEL = Entity::class;

    public function __construct()
    {
        $this->entity = new Entity();
    }

    public function firstUser($data)
    {
        return $this->entity
            ->where('email', $data)
            ->orWhere('name', $data)
            ->first();
    }

}
