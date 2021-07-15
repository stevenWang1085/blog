<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\Notification;

use Illuminate\Http\Request;
use App\Management\Notification\Service as NotificationService;
use App\Http\Controllers\Notification\Transformer as NotificationTransformer;

class Controller extends \App\Http\Controllers\Controller
{
    private $notificationService;
    private $notificationTransformer;

    public function __construct()
    {
        $this->notificationService = new NotificationService();
        $this->notificationTransformer = new NotificationTransformer();
    }

    public function index(Request $request)
    {
        try {
            $result = $this->notificationService->index($request);
            $data = $this->notificationTransformer->indexTransform($result);
            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function store(Request $request)
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function show()
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function update()
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function destroy()
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }
}
