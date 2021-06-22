<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\ArticleCommentReply;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;

    protected $table = 'article_reply_comments';

    protected $fillable = [
        'user_id',
        'article_comment_id',
        'comment',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function userRelation()
    {
        return $this->belongsTo(\App\Management\User\Entity::class, 'user_id', 'id');
    }
}
