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

class Controller extends \App\Http\Controllers\Controller
{
    private $userService;

    public function __construct()
    {
        $this->userService = new UserService();
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

    public function login(Form $request)
    {
        try {
            $result = $this->userService->loginUser($request);
            if ($result === false) return $this->responseMaker(602, null, null);
            $response = $this->responseMaker(101, null, null);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

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

    public function forgetPasswordPage(Form $request)
    {
        try {
            $result = $this->userService->forgetPasswordPageCheck($request);
            if ($result === false) return $this->responseMaker(604, null, null);
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
