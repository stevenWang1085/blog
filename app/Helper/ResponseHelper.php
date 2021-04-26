<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/10/15
 * Time: 下午3:48
 */

namespace App\Helpers;

trait ResponseHelper
{
    public static function responseMaker($code, $message, $data = null)
    {
        $project_code = 001;

        switch ($code) {
            case 201:
                $response = [
                    'http_status_code' => 200,
                    'status_message' => '查詢成功',
                ];
                break;
            case 101:
                $response = [
                    'http_status_code' => 200,
                    'status_message' => '註冊成功',
                ];
                break;
            case 102:
                $response = [
                    'http_status_code' => 200,
                    'status_message' => '登入成功',
                ];
                break;
            case 103:
                $response = [
                    'http_status_code' => 200,
                    'status_message' => '信件寄送成功',
                ];
                break;
            case 104:
                $response = [
                    'http_status_code' => 200,
                    'status_message' => '修改密碼成功',
                ];
                break;
            case 105:
                $response = [
                    'http_status_code' => 200,
                    'status_message' => '代碼檢測成功',
                ];
                break;
            case 501:
                $response = [
                    'http_status_code' => 400,
                    'status_message' => '此方法不允許',
                ];
                break;
            case 502:
                $response = [
                    'http_status_code' => 403,
                    'status_message' => '無權限訪問',
                ];
                break;
            case 601:
                $response = [
                    'http_status_code' => 402,
                    'status_message' => '格式驗證錯誤，如下：'.$message
                ];
                break;
            case 602:
                $response = [
                    'http_status_code' => 400,
                    'status_message' => '帳號或密碼錯誤，請重新輸入。'
                ];
                break;
            case 603:
                $response = [
                    'http_status_code' => 400,
                    'status_message' => '更新信箱失敗。'
                ];
                break;
            case 604:
                $response = [
                    'http_status_code' => 400,
                    'status_message' => '更新密碼失敗。'
                ];
                break;
            case 605:
                $response = [
                    'http_status_code' => 400,
                    'status_message' => '重置代碼失效或是錯誤的代碼。'
                ];
                break;
            default:
                $response = [
                    'http_status_code' => 400,
                    'code' => '',
                    'status_message' => '錯誤的Request',
                ];
        }
        $response['return_data'] = $data;
        $response['code'] = $project_code.$code;

        return $response;
    }
}
