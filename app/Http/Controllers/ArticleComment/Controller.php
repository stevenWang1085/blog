<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\ArticleComment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Management\ArticleComment\Service as ArticleCommentService;

class Controller extends \App\Http\Controllers\Controller
{
    private $articleCommentService;

    public function __construct()
    {
        $this->articleCommentService = new ArticleCommentService();
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
