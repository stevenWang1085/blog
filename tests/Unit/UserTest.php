<?php

namespace Tests\Unit;

use App\Management\User\Repository as UserRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testUserRegisterPage()
    {
        $response = $this->get(route('login'));

        $response->assertSuccessful();
    }

    /**
     * 使用者註冊測試
     *
     */
    public function testUserRegister()
    {
        $user_data = [
            'name'     => $this->faker->name,
            'email'    => $this->faker->email,
            'password' => 'dwdwdsswd'
        ];

        $response = $this->post('api/user', $user_data);
        $this->assertDatabaseHas('users', [
            'name'     => $user_data['name'],
            'email'    => $user_data['email']
        ]);

        $response->assertOk();
    }

    /**
     *  使用者註冊資料驗證
     *
     */
    public function testUserRegisterValidate()
    {
        $this->post('api/user', [
            'name' => 'steven',
            'email' => '0ada@mail.com',
            'password' => 'asas122'
        ]);

        #email重複
        $response = $this->post('api/user', [
            'name' => 'steven2',
            'email' => '0ada@mail.com',
            'password' => 'asa2'
        ]);

        $response->assertStatus(402);
    }

    /**
     * 登入測試
     *
     */
    public function testUserLogin()
    {
        $this->withoutExceptionHandling();

        #註冊
        $this->post('api/user', [
            'name' => 'steven',
            'email' => 'steven@mail.com',
            'password' => 'password'
        ]);

        #登入
        $response = $this->post('api/user/login', [
            'email'    => 'steven@mail.com',
            'password' => 'password'
        ]);

        $response->assertOk();
    }

    public function SendEmail()
    {
        Mail::send('welcome', [], function($message) {
            $message->to('4a114019@stust.edu.tw')->subject('Testing mails');
        });

    }

    /**
     * 測試寄送重置密碼信件
     *
     */
    public function testForgetPasswordSendEmail()
    {
        $this->withoutExceptionHandling();

        $this->post('api/user', [
            'name' => 'steven',
            'email' => '4a114019@stust.edu.tw',
            'password' => '123456'
        ]);

        $response = $this->post('api/user/forget_password/send', [
            'email' => '4a114019@stust.edu.tw',
        ]);

        $response->assertOk();
    }

    /**
     * 測試重置密碼頁面
     *
     */
    public function testResetPasswordPageCheck()
    {
        $user_data = new  UserRepository();
        $user_data->insert(
            [
                'name' => 'steven',
                'email' => '4a114019@stust.edu.tw',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'reset_password_code' => 'reset_code',
                'reset_password_limit_time' => '2022-04-26 10:59:11'
            ]
        );
        $response = $this->post('api/user/forget_password/page', [
            'reset_password_code' => 'reset_code',
        ]);
        $response->assertOk();
    }

    /**
     * 測試重置密碼
     *
     */
    public function testResetPasswordCheck()
    {
        $this->withoutExceptionHandling();

        $user_data = new  UserRepository();
        $user_data->insert(
            [
                'name' => 'steven',
                'email' => '4a114019@stust.edu.tw',
                'password' => password_hash('123456', PASSWORD_DEFAULT),
                'reset_password_code' => 'reset_code'
            ]
        );

        $response = $this->post('api/user/forget_password/check', [
            'email'                  => '4a114019@stust.edu.tw',
            'reset_password'         => 'reset123456',
            'confirm_reset_password' => 'reset123456',
            'reset_password_code'    => 'reset_code',
        ]);

        $check_user_data = $user_data->first(['email' => '4a114019@stust.edu.tw',]);

        $this->assertDatabaseMissing('users', [
            'email'               => "4a114019@stust.edu.tw",
            'reset_password_code' => 'reset_code',
        ]);
        $this->assertTrue(password_verify('reset123456', $check_user_data['password']));
        $response->assertOk();
    }


}
