<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\User;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
        'reset_password_code',
        'reset_password_limit_time'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
