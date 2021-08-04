<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\Board;

use App\Management\Board\SearchService\Search;
use App\Management\Board\Service as BoardService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Board\Transformer as BoardTransformer;

class Controller extends \App\Http\Controllers\Controller
{
    private $boardService;
    private $boardTransformer;

    public function __construct()
    {
        $this->boardService = new BoardService();
        $this->boardTransformer = new BoardTransformer();
    }

    /**
     *
     *  @OA\Get(
     *     path="/api/v1/board",
     *     tags={"Board"},
     *     summary="取得看板列表",
     *     description="取得看板列表",
     *     @OA\Parameter(
     *         name="name",
     *         description="看板名稱",
     *         required=false,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1201", description="查詢成功"),
     *     @OA\Response(response="1202", description="查無資料"),
     *     @OA\Response(response="1500", description="程式異常程式異常")
     *
     * )
     */
    public function index(Form $request)
    {
        try {
            $filters = [
                'name' => $request->name,
                'per_page' => 20,
            ];
            $result = Search::apply($filters, 'page');
            if (count($result) === 0) return $this->responseMaker(202, null, null);
            $data = $this->boardTransformer->boardIndexTransformer($result, $filters['per_page']);

            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(500, $e->getMessage(), null);
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
            $response = $this->responseMaker(500, $e->getMessage(), null);
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
            $response = $this->responseMaker(500, $e->getMessage(), null);
        }
        return $response;
    }
}
