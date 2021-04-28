<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:00
 */

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Management\Article\Service as ArticleService;
use Illuminate\Support\Facades\DB;

class Controller extends \App\Http\Controllers\Controller
{
    private $articleService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
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
            $result = $this->articleService->store($request);
            if ($result === false) return $this->responseMaker(607, null, null);
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
