<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Management\User\Service as UserService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\User\Transformer as UserTransFormer;

class Controller extends \App\Http\Controllers\Controller
{
    private $userService;
    private $userTransFormer;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->userTransFormer = new UserTransFormer();
    }

    public function index()
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/user/login",
     *     tags={"User"},
     *     summary="使用者登入",
     *     description="使用者登入",
     *     @OA\Parameter(
     *         name="email",
     *         description="信箱",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         description="密碼",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1602", description="帳號或密碼錯誤"),
     *     @OA\Response(response="1102", description="登入成功"),
     *     @OA\Response(response="1601", description="請求格式錯誤")
     *
     * )
     */
    public function login(Form $request)
    {
        try {
            $result = $this->userService->loginUser($request);
            if ($result === false) return $this->responseMaker(602, null, null);
            $response = $this->responseMaker(102, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function logout()
    {
        try {
            session()->remove('user_id');
            $response = $this->responseMaker(109, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/user/forget_password/send",
     *     tags={"User"},
     *     summary="使用者登入",
     *     description="使用者登入",
     *     @OA\Parameter(
     *         name="email",
     *         description="信箱",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         description="密碼",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1602", description="帳號或密碼錯誤"),
     *     @OA\Response(response="1102", description="登入成功"),
     *     @OA\Response(response="1601", description="請求格式錯誤")
     *
     * )
     */
    public function forgetPasswordSendEmail(Form $request)
    {
        try {
            $result = $this->userService->forgetPasswordSendEmail($request);
            if ($result === false) return $this->responseMaker(603, null, null);
            $response = $this->responseMaker(103, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function resetCodeCheck(Form $request)
    {
        try {
            $result = $this->userService->resetCodeCheck($request);
            if ($result === false) return $this->responseMaker(701, null, null);
            $response = $this->responseMaker(105, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function resetCodePageCheck(Form $request)
    {
        try {
            $result = $this->userService->resetCodePageCheck($request);
            if ($result === false) return $this->responseMaker(701, null, null);
            $response = $this->responseMaker(105, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function forgetPasswordCheck(Form $request)
    {
        try {
            $result = $this->userService->forgetPasswordCheck($request);
            if ($result === false) return $this->responseMaker(603, null, null);
            $response = $this->responseMaker(104, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/user/register",
     *     tags={"User"},
     *     summary="使用者註冊",
     *     description="使用者註冊",
     *     @OA\Parameter(
     *         name="name",
     *         description="姓名",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="email",
     *         description="信箱",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="password",
     *         description="密碼",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1101", description="註冊成功"),
     *     @OA\Response(response="1601", description="請求格式錯誤")
     *
     * )
     */
    public function store(Form $request)
    {
        try {
            DB::beginTransaction();
            $this->userService->registerUser($request);
            $response = $this->responseMaker(101, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function getCurrentUser()
    {
        try {
            $result = $this->userService->getCurrentUser();
            $data = $this->userTransFormer->getCurrentUserTransform($result);
            $response = $this->responseMaker(201, null, $data);
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
