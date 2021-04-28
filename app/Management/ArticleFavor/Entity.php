<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\ArticleFavor;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $table = 'article_favors';

    protected $fillable = [
        'article_id',
        'user_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
