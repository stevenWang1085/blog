<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\User;

use App\Events\UserRegistered;
use App\Jobs\SendEmail;
use App\Management\BaseService;


class Service extends BaseService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new Repository();
    }

    public function getCurrentUser()
    {
        return $this->repository->find(session()->get('user_id'));
    }

    /**
     * 使用者註冊
     *
     * @param $request
     * @return mixed
     */
    public function registerUser($request)
    {
        $user_data = [
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => password_hash($request->password, PASSWORD_DEFAULT)
        ];

        if ($this->repository->insert($user_data)) {
            event(new UserRegistered($user_data));
        }

        return false;
    }

    /**
     * 使用者登入
     *
     * @param $request
     * @return bool
     */
    public function loginUser($request)
    {
        $user_data = $this->repository->firstUser($request->email);
        if ($user_data === null || password_verify($request->password, $user_data['password']) === false) return false;
        session()->put('user_id', $user_data->id);

        return true;
    }

    /**
     * 忘記密碼寄信
     *
     * @param $request
     * @return bool
     */
    public function forgetPasswordSendEmail($request)
    {
        $env = config('app.env');

        if ($env !== 'prod') {
            $host = "http://localhost:90/reset_password.html";
        } else {
            $host = "http://35.221.149.244/reset_password.html";
        }

        $mail_to = $request->email;
        $now = time();
        $reset_code = md5($now);
        $link_limit_time = date('Y-m-d H:i:s', strtotime("+5 min", $now));
        $title = "[會員重置密碼]";
        $content = "會員：{$mail_to}";
        $content .= "重置代碼：".$reset_code.PHP_EOL;
        $link = "{$host}?email={$mail_to}";
        $data = [
            'subject' => $title,
            'content' => nl2br($content),
            'link'    => $link,
            'link_limit_time' => $link_limit_time
        ];

        if ($this->updateResetData($mail_to, $reset_code, $link_limit_time)) {
            $job = new SendEmail('reset_password', $data, $title, $mail_to);
            dispatch($job);

            return true;
        }

        return false;
    }

    /**
     * 更新重置資料
     *
     * @param $mail
     * @param $reset_code
     * @param $link_limit_time
     * @return bool
     */
    private function updateResetData($mail, $reset_code, $link_limit_time)
    {
        $where = ['email' => $mail];
        $update_data = [
            'reset_password_code'       => $reset_code,
            'reset_password_limit_time' => $link_limit_time
        ];
        $result = $this->repository->updateWheres($where, $update_data);
        if ($result === 0) return false;

        return true;
    }

    /**
     * 重置密碼
     *
     * @param $request
     * @return bool
     */
    public function forgetPasswordCheck($request)
    {
        #驗證reset_code
        $check_email = $this->repository->first(['reset_password_code' => $request->reset_password_code]);
        if ($check_email === null) return false;

        #更新密碼
        $where = ['email' => $request->email];
        $update = [
            'password'                  => password_hash($request->reset_password, PASSWORD_DEFAULT),
            'reset_password_code'       => null,
            'reset_password_limit_time' => null
        ];
        $update_check = $this->repository->updateWheres($where, $update);

        if ($update_check != true) return false;

        return true;
    }

    /**
     * 重置密碼頁面檢測
     *
     * @param $request
     * @return bool
     */
    public function resetCodeCheck($request)
    {
        $user_data = $this->repository->first(['reset_password_code' => $request->reset_password_code]);
        #檢測重置碼是否過期
        if (is_null($user_data) || time() > strtotime($user_data['reset_password_limit_time'])) return false;

        return true;
    }

    public function resetCodePageCheck($request)
    {
        $user_data = $this->repository->first(['email' => $request->email]);
        #檢測信箱是否有被重設密碼
        if (is_null($user_data['reset_password_code'])) return false;

        return true;
    }
}
