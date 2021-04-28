<?php

namespace Tests\Feature;

use App\Management\Article\Repository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleCommentTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testCreateComment()
    {
        $this->setArticleInit();

        $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);

        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $response = $this->post("api/article/{$data->id}/comment", [
            'comment' => 'comment1'
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('article_comments', [
            'article_id' => $data->id,
            'user_id'    => 1,
            'comment'    => 'comment1',
        ]);
    }

    public function testUpdateComment()
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

        $response = $this->patch("api/article/{$data->id}/comment", [
            'comment' => '123'
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('article_comments', [
            'article_id' => $data->id,
            'user_id'    => 1,
            'comment'    => '123',
        ]);
        $comment = new \App\Management\ArticleComment\Repository();
        $comment_data = $comment->first(['article_id' => $data->id, 'user_id' => 1]);
        $this->assertEquals('123', $comment_data['comment']);
    }

    public function testDeleteComment()
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

        $response = $this->delete("api/article/{$data->id}/comment");
        $response->assertOk();
        $this->assertSoftDeleted('article_comments', [
            'id' => $data->id
        ]);
    }

}
