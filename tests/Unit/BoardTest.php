<?php

namespace Tests\Unit;

use App\Management\Board\Repository;
use App\Management\User\Entity;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoardTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    private $board;
    private $user;

    public function __construct()
    {
        parent::__construct();
        $this->board = new Repository();
        $this->user = new \App\Management\User\Repository();
    }

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testCreateBoard()
    {
       factory(Entity::class)->create();

       $data = [
           'name' => '閒聊',
           'memo' => '什麼都聊',
           'edited_user_id' => 1
       ];
       $this->board->insert($data);

       $this->assertDatabaseHas('boards', $data);
    }

    public function testBoardSeeder()
    {
        $this->seed('RootSeeder');
        $this->seed('BoardSeeder');

        $data = [
            [
                'name' => '閒聊',
                'memo' => '瞎聊',
                'edited_user_id' => 1
            ],
            [
                'name' => '工作',
                'memo' => '我喜歡寫程式',
                'edited_user_id' => 1
            ],
            [
                'name' => '靈異',
                'memo' => '怕.jpg',
                'edited_user_id' => 1
            ],
            [
                'name' => '感情',
                'memo' => '魯起來',
                'edited_user_id' => 1
            ],
        ];

        $this->assertCount(4, $this->board->get([])->toArray());
        foreach ($data as $value) {
            $this->assertDatabaseHas('boards', ['name' => $value['name']]);
        }
    }
}
