<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:02
 */

namespace App\Http\Controllers\Notification;


class Transformer
{

    public function indexTransform($result)
    {
        $data = [];

        foreach ($result as $key => $value) {
            $data[] = [
                'article_id' => $value['data']['article_id'],
                'message'    => $this->processNotifyType($value['data']),
                'time'       => $value['data']['time'],
                'type'       => $value['data']['notify_type']
            ];
        }

        return $data;
    }

    private function processNotifyType($data)
    {
        switch ($data['notify_type']) {
            case 'favor':
                $message = "[{$data['notify_from_user_name']}]對你的文章『{$data['article_title']}』按了讚。";
                break;
            case 'article_reply':
                $message = "[{$data['notify_from_user_name']}]於你的文章『{$data['article_title']}』下有新的留言。";
                break;
            case 'article_comment_reply':
                $message = "[{$data['notify_from_user_name']}]於你在文章『{$data['article_title']}』下的留言[{$data['article_comment']}]有新回覆。";
                break;
            default:
                $message = "error";
        }

        return $message;
    }
}
