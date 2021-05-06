<?php

namespace Tests\Feature;

use App\Management\Article\Entity;
use App\Management\Article\Repository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
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

    public function testGetArticle()
    {
        $this->setArticleInit();

        $response = $this->call('get', 'api/article', []);
        $response->assertJson([
            "http_status_code" => 200,
            "status_message"   => "查無資料",
            "return_data"      => null,
            "code"             => "1202"
        ]);

        $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);

        $response = $this->call('get', 'api/article', [
            'content' => '安安你好'
        ]);
        $this->assertDatabaseHas('articles', ['content' => '安安你好']);
        $response->assertOk();
    }

    public function testGetOneArticle()
    {
        $this->setArticleInit();
        $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);
        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $response = $this->get('api/article/'.$data['id']);

        $response->assertJson(['return_data' => [
            'id'       => 1,
            'title'    => '閒聊',
            'content'  => '安安你好',
            'board_id' => 1,
            'favor'    => 0
        ]]);
    }

    public function testCreateArticle()
    {
        $this->setArticleInit();

        $response = $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);

        $response->assertOk();
        $this->assertDatabaseHas('articles', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);
    }

    public function testUpdateArticle()
    {
        $this->setArticleInit();

        $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);
        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $response = $this->patch('api/article/'.$data->id, [
            'title' => '閒聊->edit',
            'content' => '安安你好->edit'
        ]);
        $article_data = $article->find($data->id);

        $response->assertOk();
        $this->assertEquals('閒聊->edit', $article_data['title']);
        $this->assertEquals('安安你好->edit', $article_data['content']);
    }

    public function testUpdateArticleFavor()
    {
        $this->setArticleInit();
        $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);
        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $response = $this->patch('api/article/'.$data->id.'/favor');
        $check_data = $article->find($data->id);

        $response->assertOk();
        $this->assertEquals(1, $check_data['favor']);

        $response = $this->patch('api/article/'.$data->id.'/favor');
        $check_data = $article->find($data->id);

        $response->assertOk();
        $this->assertEquals(0, $check_data['favor']);
    }

    public function testDeleteArticle()
    {
        $this->setArticleInit();
        $this->post('api/article', [
            'board_id' => 1,
            'title' => '閒聊',
            'content' => '安安你好'
        ]);
        $article = new Repository();
        $data = $article->first(['title' => '閒聊']);
        $response = $this->delete('api/article/'.$data->id);
        $response->assertOk();
        $this->assertSoftDeleted('articles', [
            'title' => '閒聊'
        ]);
    }
}
