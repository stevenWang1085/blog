<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\ArticleComment;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'article_comments';
    protected $cascadeDeletes = ['articleReplyCommentRelation'];

    protected $fillable = [
        'article_id',
        'user_id',
        'comment',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function userRelation()
    {
        return $this->belongsTo(\App\Management\User\Entity::class, 'user_id', 'id');
    }

    public function articleReplyCommentRelation()
    {
        return $this->hasMany(\App\Management\ArticleCommentReply\Entity::class, 'article_comment_id', 'id');
    }
}
