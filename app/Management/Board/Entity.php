<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\Board;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'boards';

    protected $fillable = [
        'name',
        'memo',
        'edited_user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
