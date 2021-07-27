<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\ArticleComment;

use App\Management\ArticleComment\SearchService\Search;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Management\ArticleComment\Service as ArticleCommentService;
use App\Http\Controllers\ArticleComment\Transformer as ArticleCommentTransformer;

class Controller extends \App\Http\Controllers\Controller
{
    private $articleCommentService;
    private $articleCommentTransformer;

    public function __construct()
    {
        $this->articleCommentService = new ArticleCommentService();
        $this->articleCommentTransformer = new ArticleCommentTransformer();
    }
    /**
     *
     *  @OA\Get(
     *     path="/api/article/{article_id}/comment",
     *     tags={"Article Comment"},
     *     summary="取得指定文章所有留言",
     *     description="取得指定文章所有留言與回覆訊息",
     *     @OA\Parameter(
     *         name="article_id",
     *         description="文章編號",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="1201", description="查詢成功"),
     *     @OA\Response(response="1202", description="查無資料"),
     *     @OA\Response(response="400", description="程式異常")
     *
     * )
     */
    public function index(Form $request, $article_id)
    {
        try {
            $filters = [
                'article_id' => $article_id,
                'per_page'   => 20
            ];
            $result = Search::apply($filters, 'page');
            if (count($result) === 0) return $this->responseMaker(202, null, null);
            $data = $this->articleCommentTransformer->articleCommentIndexTransform($result, $filters['per_page']);
            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Post(
     *     path="/api/article/{article_id}/comment",
     *     tags={"Article Comment"},
     *     summary="於指定文章新增留言",
     *     description="於指定文章新增留言",
     *     @OA\Parameter(
     *         name="article_id",
     *         description="文章編號",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="comment",
     *         description="留言內容",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1108", description="新增成功"),
     *     @OA\Response(response="1608", description="新增異常")
     *
     * )
     */
    public function store(Form $request, $article_id)
    {
        try {
            DB::beginTransaction();
            $this->articleCommentService->store($request, $article_id);
            $response = $this->responseMaker(108, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(608, $e->getMessage(), null);
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

    /**
     *
     *  @OA\Patch(
     *     path="/api/article_comment/{comment_id}",
     *     tags={"Article Comment"},
     *     summary="指定文章內之留言更新",
     *     description="指定文章內之留言更新",
     *     @OA\Parameter(
     *         name="comment_id",
     *         description="留言編號",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *    @OA\Parameter(
     *         name="comment",
     *         description="留言內容",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(response="1302", description="更新成功"),
     *     @OA\Response(response="1802", description="更新異常")
     *
     * )
     */
    public function update(Form $request, $comment_id)
    {
        try {
            DB::beginTransaction();
            $this->articleCommentService->update($request, $comment_id);
            $response = $this->responseMaker(302, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(802, $e->getMessage(), null);
        }
        return $response;
    }

    /**
     *
     *  @OA\Delete(
     *     path="/api/article_comment/{comment_id}",
     *     tags={"Article Comment"},
     *     summary="指定文章內之留言刪除",
     *     description="指定文章內之留言刪除",
     *     @OA\Parameter(
     *         name="comment_id",
     *         description="留言編號",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="1402", description="刪除成功"),
     *     @OA\Response(response="1902", description="刪除異常")
     *
     * )
     */
    public function destroy(Form $request, $comment_id)
    {
        try {
            DB::beginTransaction();
            $this->articleCommentService->delete($comment_id);
            $response = $this->responseMaker(402, null, null);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $response = $this->responseMaker(902, $e->getMessage(), null);
        }
        return $response;
    }
}
