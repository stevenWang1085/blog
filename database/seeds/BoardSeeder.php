<?php

use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insert = [
            [
                'name' => '閒聊',
                'memo' => '瞎聊',
                'edited_user_id' => 1
            ],
            [
                'name' => '工作',
                'memo' => '我喜歡工作',
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

        $board = new \App\Management\Board\Repository();
        foreach ($insert as $value) {
            $board->updateOrCreate(['name' => $value['name']], $value);
        }
    }
}
