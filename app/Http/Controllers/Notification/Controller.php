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
    /**
     *
     *  @OA\Get(
     *     path="/api/v1/notification",
     *     tags={"Notification"},
     *     summary="取得通知列表",
     *     description="取得通知列表",
     *     @OA\Parameter(
     *         name="status",
     *         description="通知狀態 (read:已讀、unread:未讀)",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1201", description="查詢成功"),
     *     @OA\Response(response="1202", description="查無資料"),
     *     @OA\Response(response="1500", description="程式異常")
     *
     * )
     */
    public function index(Request $request)
    {
        try {
            $result = $this->notificationService->index($request);
            if (count($result) == 0) return $this->responseMaker(202, null, []);
            $data = $this->notificationTransformer->indexTransform($result);
            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    public function store(Request $request)
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    public function show()
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Patch(
     *     path="/api/v1/notification/read/all",
     *     tags={"Notification"},
     *     summary="已讀全部通知",
     *     description="已讀全部通知",
     *
     *     @OA\Response(response="302", description="更新成功"),
     *     @OA\Response(response="1500", description="程式異常")
     *
     * )
     */
    public function update()
    {
        try {
            $this->notificationService->update();
            $response = $this->responseMaker(302, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }
    /**
     *
     *  @OA\Delete(
     *     path="/api/v1/notification/clean/all",
     *     tags={"Notification"},
     *     summary="刪除全部通知",
     *     description="刪除全部通知",
     *
     *     @OA\Response(response="1302", description="刪除成功"),
     *     @OA\Response(response="1202", description="查無資料"),
     *     @OA\Response(response="1500", description="程式異常")
     *
     * )
     */
    public function destroy()
    {
        try {
            $this->notificationService->delete();
            $response = $this->responseMaker(402, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }
}
