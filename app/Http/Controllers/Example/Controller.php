<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\Example;

use Illuminate\Http\Request;

class Controller extends \App\Http\Controllers\Controller
{
    public function index()
    {
        try {
            $response = $this->responseMaker(501, null, null);
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
