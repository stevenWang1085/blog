<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:01
 */

namespace App\Http\Controllers\User;

#custom use
use App\Http\Controllers\BaseForm;

class Form extends BaseForm
{
    public function rules()
    {
        $identifier = $this->getFunctionIdentifier();
        switch ($identifier) {
            case "login":
                $different_rules = [
                    'email'    => 'required|email|exists:users',
                    'password' => 'required|min:6'
                ];
                break;
            case "store":
                $different_rules = [
                    'name'     => 'required',
                    'email'    => 'required|email|unique:users',
                    'password' => 'required|min:6'
                ];
                break;
            case "forgetPasswordSendEmail":
                $different_rules = [
                    'email'    => 'required|email|exists:users',
                ];
                break;
            case "forgetPasswordCheck":
                $different_rules = [
                    'email'                  => 'required|email|exists:users',
                    'reset_password'         => 'required|min:6',
                    'confirm_reset_password' => 'required|min:6|same:reset_password',
                    'reset_password_code'    => 'required|exists:users'
                ];
                break;
            case "forgetPasswordPage":
                $different_rules = [
                    'reset_password_code' => 'required|exists:users',
                ];
                break;
            default:
                $different_rules = [];
                break;
        }

        return $different_rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages()
    {
        return [
            'required'     => ':attribute為必填。',
            'min'          => ':attribute長度需大於六位字元。',
            'email'        => ":attribute須為正確格式。",
            'email.unique' => "信箱已被註冊過，請更換。",
            'email.exists' => "信箱不存在，請註冊。",
            'confirm_reset_password.same' => "密碼請輸入一致。",
            'reset_password_code.exists' => "重置代碼錯誤。"
        ];
    }

    public function attributes()
    {
        return [
            'name'                   => '名稱',
            'email'                  => '信箱',
            'password'               => '密碼',
            'reset_password_code'    => '重置代碼',
            'reset_password'         => '重置密碼',
            'confirm_reset_password' => '確認重置密碼'
        ];
    }
}
