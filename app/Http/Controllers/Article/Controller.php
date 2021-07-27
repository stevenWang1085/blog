<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\Article;

use App\Management\Article\SearchService\Search;
use Illuminate\Http\Request;
use App\Management\Article\Service as ArticleService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Article\Transformer as ArticleTransformer;

class Controller extends \App\Http\Controllers\Controller
{
    private $articleService;
    private $articleTransformer;

    public function __construct()
    {
        $this->articleService = new ArticleService();
        $this->articleTransformer = new ArticleTransformer();
    }

    /**
     *
     *  @OA\Get(
     *     path="/api/article",
     *     tags={"Article"},
     *     summary="取得文章列表",
     *     description="取得文章列表",
     *     @OA\Parameter(
     *         name="order_column",
     *         description="排序欄位(created_at、favor、comments)",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="order_column_by",
     *         description="排序形式(asc、desc)",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="board_id",
     *         description="看板代號",
     *         required=false,
     *         in="query",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="title",
     *         description="標題",
     *         required=false,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="contents",
     *         description="內容",
     *         required=false,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1201", description="查詢成功"),
     *     @OA\Response(response="1202", description="查無資料"),
     *     @OA\Response(response="400", description="程式異常")
     *
     * )
     */
    public function index(Form $request)
    {
        try {
            $filters = [
                'board_id'        => $request->board_id,
                'contents'        => $request->contents,
                'title'           => $request->title,
                'order_column'    => $request->order_column,
                'order_column_by' => $request->order_column_by,
                'per_page'        => $request->per_page ?? 20,
                'edited_user_id'  => $request->edited_user_id == 1 ? session()->get('user_id') : null
            ];
            $result = Search::apply($filters, 'page');
            if (count($result) === 0) return $this->responseMaker(202, null, null);
            $data = $this->articleTransformer->articleIndexTransform($result, $filters['per_page']);
            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }
    /**
     * @OA\Post(
     *      path="/api/article",
     *      tags={"Article"},
     *      summary="新增文章",
     *      description="指定看板新增文章",
     *      @OA\Parameter(
     *          name="board_id",
     *          description="看板代號",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="title",
     *          description="文章標題",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="content",
     *          description="文章內容",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="資源成功建立"
     *       ),
     *      @OA\Response(
     *          response=1601,
     *          description="請求格式錯誤"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="程式異常"
     *       )
     * )
     *
     */
    public function store(Form $request)
    {
        try {
            DB::beginTransaction();
            $result = $this->articleService->store($request);
            if ($result === false) return $this->responseMaker(607, null, null);
            $response = $this->responseMaker(108, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     * @OA\Get(
     *      path="/api/article/{id}",
     *      tags={"Article"},
     *      summary="取得文章詳情",
     *      description="取得文章詳情",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="查詢成功"),
     *     @OA\Response(response="1202", description="查無資料"),
     * )
     */
    public function show(Form $request, $id)
    {
        try {
            $result = $this->articleService->showOneArticle($id);
            if (is_null($result)) return $this->responseMaker(202, null, null);
            $data = $this->articleTransformer->articleShowTransform($result);
            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     * @OA\Patch(
     *      path="/api/article/{id}",
     *      tags={"Article"},
     *      summary="更新文章",
     *      description="更新文章",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="title",
     *          description="文章標題",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="content",
     *          description="文章內容",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *     @OA\Response(response="200", description="更新成功"),
     *     @OA\Response(response="400", description="更新失敗"),
     *     @OA\Response(response="1601", description="請求格式錯誤"),
     * )
     */
    public function update(Form $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = $this->articleService->update($request, $id);
            if ($result === false) return $this->responseMaker(802, null, null);
            $response = $this->responseMaker(302, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }
    /**
     * @OA\Patch(
     *      path="/api/article/{id}/favor",
     *      tags={"Article"},
     *      summary="按讚文章",
     *      description="按讚文章",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="更新成功"),
     *     @OA\Response(response="400", description="更新失敗"),
     * )
     */
    public function updateFavor(Form $request, $id)
    {
        try {
            DB::beginTransaction();
            $this->articleService->updateFavor($id);
            $response = $this->responseMaker(302, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(802, $e->getMessage(), null);
        }
        return $response;
    }
    /**
     * @OA\Delete(
     *      path="/api/article/{id}",
     *      tags={"Article"},
     *      summary="刪除文章",
     *      description="刪除文章",
     *      @OA\Parameter(
     *          name="id",
     *          description="Article ID",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *     @OA\Response(response="200", description="刪除成功"),
     *     @OA\Response(response="400", description="刪除失敗"),
     * )
     */
    public function destroy(Form $request, $id)
    {
        try {
            DB::beginTransaction();
            $result = $this->articleService->delete($id);
            if ($result === false) return $this->responseMaker(902, null, null);
            $response = $this->responseMaker(402, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(902, $e->getMessage(), null);
        }
        return $response;
    }
}
