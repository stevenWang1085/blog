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

    public function index(Form $request)
    {
        try {
            $filters = [
                'board_id' => $request->board_id,
                'contents' => $request->contents,
                'title'    => $request->title,
                'per_page' => $request->per_page ?? 20
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

    public function show(Form $request, $id)
    {
        try {
            $result = $this->articleService->showOneArticle($id);
            $data = $this->articleTransformer->articleShowTransform($result);
            $response = $this->responseMaker(201, null, $data);
        } catch (\Exception $e) {
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }

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
            $response = $this->responseMaker(1, $e->getMessage(), null);
        }
        return $response;
    }
}
