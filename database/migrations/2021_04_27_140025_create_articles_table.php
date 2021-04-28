<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('board_id')->unsigned();
            $table->string('title', 30)->comment('標題');
            $table->text('content')->comment('內容');
            $table->integer('favor')->default(0)->comment('按讚數');
            $table->integer('edited_user_id')->comment('編輯者')->unsigned();
            $table->softDeletes();
            $table->foreign('edited_user_id')
                ->references('id')
                ->on('users');
            $table->foreign('board_id')
                ->references('id')
                ->on('boards');
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
        Schema::dropIfExists('articles');
    }
}
