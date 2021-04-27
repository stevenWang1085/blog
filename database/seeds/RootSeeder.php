<?php

use Illuminate\Database\Seeder;

class RootSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $search_data = [
            'name'     => 'root',
            'email'    => 'root@mail.com',
        ];
        $data = [
            'name'     => 'root',
            'email'    => 'root@mail.com',
            'password' => password_hash('root', PASSWORD_DEFAULT),
            'is_root'  => 1
        ];
        $user = new \App\Management\User\Repository();
        $user->updateOrCreate($search_data, $data);
    }
}
