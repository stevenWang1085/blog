<?php

namespace Tests\Feature;

use App\Management\Article\Repository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleReplyCommentTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testArticleReplyCommentTest()
    {
        $this->setArticleInit();
        $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);
        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $this->post("api/article/{$data->id}/comment", [
            'comment' => 'comment1'
        ]);
        $comment = new \App\Management\ArticleComment\Repository();
        $comment_data = $comment->find(1);
        $response = $this->post("api/comment/{$comment_data->id}/reply", [
            'comment' => 'im reply comment',
            'article_id' => $data->id
        ]);
        $response->assertOk();
        $this->assertDatabaseHas('article_reply_comments', [
            'article_comment_id' => $comment_data->id,
            'comment' => 'im reply comment'
        ]);
    }

    public function testGetReplyComment()
    {
        $this->testArticleReplyCommentTest();
        $this->get("api/article/1/comment");
    }
}
