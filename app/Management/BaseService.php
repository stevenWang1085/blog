<?php
namespace App\Management;


use App\Management\User\Repository;

abstract class BaseService
{
    public function __get($name)
    {
        if ($name == 'user_id') {
            return session()->get('user_id');
        }

        if ($name === 'user_name') {
            $user = new Repository();
            return  $user->find(session()->get('user_id'))['name'];
        }
    }
}
