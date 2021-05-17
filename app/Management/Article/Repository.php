<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\Article;

use App\Management\BaseRepository;

class Repository extends BaseRepository
{
    private $entity;

    const MODEL = Entity::class;

    public function __construct()
    {
        $this->entity = new Entity();
    }

    public function getOneWithRelation($id, $relations)
    {
        return $this->entity
            ->with($relations)
            ->where('id', $id)
            ->first();
    }

}
