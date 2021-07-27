<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\ArticleCommentReply;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Management\ArticleCommentReply\Service as ArticleCommentReplyService;


class Controller extends \App\Http\Controllers\Controller
{
    private $articleCommentReplyService;

    public function __construct()
    {
        $this->articleCommentReplyService = new ArticleCommentReplyService();
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
     *     path="/api/comment/{comment_id}/reply",
     *     tags={"Article Comment Reply"},
     *     summary="於指定文章留言新增回覆訊息",
     *     description="於指定文章留言新增回覆訊息",
     *     @OA\Parameter(
     *         name="comment_id",
     *         description="留言編號",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="comment",
     *         description="回覆內容",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="article_id",
     *         description="文章編號",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(response="1108", description="新增成功"),
     *     @OA\Response(response="400", description="新增異常")
     *
     * )
     */
    public function store(Form $request, $comment_id)
    {
        try {
            DB::beginTransaction();
            $this->articleCommentReplyService->store($request, $comment_id);
            $response = $this->responseMaker(108, null, null);
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
