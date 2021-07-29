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
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/v1/user/login",
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
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    public function logout()
    {
        try {
            session()->remove('user_id');
            $response = $this->responseMaker(109, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/v1/user/forget_password/send",
     *     tags={"User"},
     *     summary="寄送郵件(忘記密碼)",
     *     description="點擊忘記密碼，寄送郵件",
     *     @OA\Parameter(
     *         name="email",
     *         description="信箱",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1603", description="更新信箱失敗"),
     *     @OA\Response(response="1103", description="重置信件已寄送，請至此信箱檢查。"),
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
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/v1/user/reset_code/check",
     *     tags={"User"},
     *     summary="檢測忘記密碼驗證碼",
     *     description="檢測忘記密碼驗證碼",
     *     @OA\Parameter(
     *         name="reset_password_code",
     *         description="驗證碼",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1701", description="請檢查代碼並確認連結失效或是信箱錯誤。"),
     *     @OA\Response(response="1105", description="代碼檢測成功"),
     *     @OA\Response(response="1601", description="請求格式錯誤")
     *
     * )
     */
    public function resetCodeCheck(Form $request)
    {
        try {
            $result = $this->userService->resetCodeCheck($request);
            if ($result === false) return $this->responseMaker(701, null, null);
            $response = $this->responseMaker(105, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }
    /**
     *
     *  @OA\Get(
     *     path="/api/v1/user/reset_code_page/check",
     *     tags={"User"},
     *     summary="檢測信箱是否有被重設密碼",
     *     description="檢測信箱是否有被重設密碼",
     *     @OA\Parameter(
     *         name="email",
     *         description="信箱",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1702", description="此信箱沒有設置重置密碼。"),
     *     @OA\Response(response="1110", description="信箱檢測成功"),
     *     @OA\Response(response="1601", description="請求格式錯誤")
     *
     * )
     */
    public function resetCodePageCheck(Form $request)
    {
        try {
            $result = $this->userService->resetCodePageCheck($request);
            if ($result === false) return $this->responseMaker(702, null, null);
            $response = $this->responseMaker(105, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }
    /**
     *
     *  @OA\Post(
     *     path="/api/v1/user/forget_password/check",
     *     tags={"User"},
     *     summary="檢測重設密碼",
     *     description="檢測重設密碼",
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
     *         name="reset_password_code",
     *         description="驗證碼",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="reset_password",
     *         description="重設密碼",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="confirm_reset_password",
     *         description="確認重設密碼",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1603", description="更新信箱失敗。"),
     *     @OA\Response(response="1104", description="修改密碼成功"),
     *     @OA\Response(response="1601", description="請求格式錯誤")
     *
     * )
     */
    public function forgetPasswordCheck(Form $request)
    {
        try {
            $result = $this->userService->forgetPasswordCheck($request);
            if ($result === false) return $this->responseMaker(603, null, null);
            $response = $this->responseMaker(104, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/v1/user/register",
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
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Get(
     *     path="/api/v1/user/get_current",
     *     tags={"User"},
     *     summary="取的當前使用者資訊",
     *     description="取的當前使用者資訊",
     *     @OA\Response(response="1503", description="尚未登入"),
     *     @OA\Response(response="1201", description="查詢成功"),
     *
     * )
     */
    public function getCurrentUser()
    {
        try {
            $result = $this->userService->getCurrentUser();
            $data = $this->userTransFormer->getCurrentUserTransform($result);
            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    public function update()
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }

    public function destroy()
    {
        try {
            $response = $this->responseMaker(501, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }
}
