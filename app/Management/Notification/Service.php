<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:05
 */

namespace App\Management\Notification;

use App\Management\BaseService;
use App\Management\User\Repository as UserRepository;

class Service extends BaseService
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function index($request)
    {
        $user_data = $this->userRepository->find($this->user_id);
        switch ($request->status) {
            case 'unread':
                $notify_data = $user_data->unreadnotifications;
                break;
            case 'read':
                $notify_data = $user_data->readnotifications;
                break;
            default:
                return [];
        }

        return $notify_data;
    }

    public function update()
    {
        $user_data = $this->userRepository->find($this->user_id);
        $notify_data = $user_data->unreadnotifications;
        $this->userRepository->updateWheres(['id' => $this->user_id], ['notification_count' => 0]);
        return $notify_data->markAsRead();
    }

    public function delete()
    {
        $user_data = $this->userRepository->find($this->user_id);
        return $user_data->notifications()->delete();
    }
}
