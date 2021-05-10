<?php

namespace Tests\Feature;

use App\Management\Board\Entity;
use App\Management\Board\Repository;
use App\Management\User\Entity as UserEntity;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use PHPUnit\Framework\MockObject\MockObject;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoardTest extends TestCase
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

    public function testGetBoard()
    {
        $this->setArticleInit();
        $response = $this->call('get', 'api/board', [
            'name' => '查無資料'
        ]);
        $response->assertJson([
            "http_status_code" => 200,
            "status_message"   => "查無資料",
            "return_data"      => null,
            "code"             => "1202"
        ]);

        $response = $this->call('get', 'api/board', [
            'name' => '閒聊'
        ]);
        $this->assertDatabaseHas('boards', ['name' => '閒聊']);
        $response->assertOk();

    }

    public function testCreateBoard()
    {
        factory(UserEntity::class)->create();
        $response = $this->post('api/board', [
            'name' => 'test1',
            'memo' => '111',
        ]);

        $this->assertDatabaseHas('boards', [
            'name' => 'test1',
            'memo' => '111',
        ]);
        $response->assertOk();
    }

    public function testUpdateBoard()
    {
        factory(UserEntity::class)->create();
        $this->post('api/board', [
            'name' => 'test1',
            'memo' => 'memo1',
        ]);
        $board = new Repository();
        $data = $board->first(['name' => 'test1']);

        $response = $this->patch('api/board/'.$data->id, [
            'name' => 'test1',
            'memo' => 'memo1_edit'
        ]);
        $data = $board->first(['id' => $data->id]);

        $response->assertOk();
        $this->assertEquals('test1', $data->name);
        $this->assertEquals('memo1_edit', $data->memo);
    }

    public function testDeleteBoard()
    {
        factory(UserEntity::class)->create();
        $this->post('api/board', [
            'name' => 'test1',
            'memo' => 'memo1',
        ]);
        $board = new Repository();
        $data = $board->first(['name' => 'test1']);

        $response = $this->delete('api/board/'.$data->id);

        $response->assertOk();
        $this->assertDatabaseMissing('boards', [
            'name' => 'test1',
            'memo' => 'memo1',
        ]);
    }


}
