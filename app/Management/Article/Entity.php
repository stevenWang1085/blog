<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\Article;

use Iatstuti\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entity extends Model
{
    use SoftDeletes;
    use CascadeSoftDeletes;

    protected $table = 'articles';

    protected $cascadeDeletes = ['articleCommentRelation', 'articleFavorRelation'];

    protected $fillable = [
        'board_id',
        'title',
        'content',
        'favor',
        'edited_user_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function userRelation()
    {
        return $this->belongsTo(\App\Management\User\Entity::class, 'edited_user_id', 'id');
    }

    public function articleFavorRelation()
    {
        return $this->hasMany(\App\Management\ArticleFavor\Entity::class, 'article_id', 'id');
    }

    public function boardRelation()
    {
        return $this->belongsTo(\App\Management\Board\Entity::class, 'board_id', 'id');
    }

    public function articleCommentRelation()
    {
        return $this->hasMany(\App\Management\ArticleComment\Entity::class, 'article_id', 'id');
    }
}
