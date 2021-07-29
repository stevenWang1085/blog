<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
/**
 * @OA\Info(title="Forum API", version="0.1")
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function responseMaker($code, $message, $data)
    {
        $result = ResponseHelper::responseMaker($code, $message, $data);

        return response()->json($result, $result['http_status_code'])
            ->header('Content-Type', 'application/json');
    }
}
