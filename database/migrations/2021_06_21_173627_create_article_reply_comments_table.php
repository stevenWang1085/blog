<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleReplyCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_reply_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('article_comment_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('comment')->comment('留言內容');

            $table->foreign('article_comment_id')
                ->references('id')
                ->on('article_comments');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_reply_comments');
    }
}
