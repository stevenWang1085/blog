<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\Board;

use App\Management\Board\Service as BoardService;
use Illuminate\Support\Facades\DB;

class Controller extends \App\Http\Controllers\Controller
{
    private $boardService;

    public function __construct()
    {
        $this->boardService = new BoardService();
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

    public function store(Form $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->boardService->store($request);
            if ($result === false) return $this->responseMaker(606, null, null);
            $response = $this->responseMaker(106, null, null);
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

    public function update(Form $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = $this->boardService->update($request, $id);
            if ($result === false) return $this->responseMaker(801, null, null);
            $response = $this->responseMaker(301, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    public function destroy(Form $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = $this->boardService->delete($id);
            if ($result === false) return $this->responseMaker(901, null, null);
            $response = $this->responseMaker(401, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }
}
