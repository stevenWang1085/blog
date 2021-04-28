<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\ArticleFavor;

use App\Management\BaseService;

class Service extends BaseService
{
    private $repository;

    public function __construct()
    {
        parent::__construct();
        $this->repository = new Repository();
    }
}
