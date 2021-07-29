<?php

namespace Tests\Feature;

use App\Management\Article\Repository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Helpers\ResponseHelper;

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

    public function testGetComment()
    {
        $this->setArticleInit();
        $this->post('api/v1/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);
        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $this->post("api/v1/article/{$data->id}/comment", [
            'comment' => 'comment1'
        ]);

        $response = $this->get("api/v1/article/{$data->id}/comment");
        $response->assertJson(['code' => "1201"]);
    }

    public function testCreateComment()
    {
        $this->setArticleInit();

        $this->post('api/v1/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);

        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $response = $this->post("api/v1/article/{$data->id}/comment", [
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

        $this->post('api/v1/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);

        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);

        $this->post("api/v1/article/{$data->id}/comment", [
            'comment' => 'comment1'
        ]);

        $response = $this->patch("api/v1/article_comment/{$data->id}", [
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

        $this->post('api/v1/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);

        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);

        $this->post("api/v1/article/{$data->id}/comment", [
            'comment' => 'comment1'
        ]);

        $response = $this->delete("api/v1/article_comment/{$data->id}");
        $response->assertOk();
        $this->assertSoftDeleted('article_comments', [
            'id' => $data->id
        ]);
    }


    public function testCountArticleComments()
    {
        $this->setArticleInit();
        $this->post('api/v1/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);

        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $this->post("api/v1/article/{$data->id}/comment", [
            'comment' => 'comment1'
        ]);
        $check_data = $article->first(['title' => '閒聊']);

        $this->assertEquals(1, $check_data['comments']);
    }

}
