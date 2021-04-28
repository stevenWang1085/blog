<?php
namespace App\Management;


abstract class BaseService
{
    public function __get($name)
    {
        if ($name == 'user_id') {
            return session()->get('user_id', 1);
        }
    }
}
