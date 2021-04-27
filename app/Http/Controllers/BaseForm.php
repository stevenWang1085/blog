<?php
namespace App\Http\Controllers;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Config;

abstract class BaseForm extends FormRequest implements IForm
{
    public function __get($key)
    {
        return $key === "method_name" ?  $this->getFunctionIdentifier() : parent::__get($key);
    }

    protected function failedAuthorization()
    {
        $response = ResponseHelper::responseMaker(502, null, null);
        throw new HttpResponseException(response()->json($response, $response['http_status_code'])->header('Content-Type', 'application/json'));
    }

    protected function getFunctionIdentifier()
    {
        return explode("@", $this->route()->action['controller'])[1];
    }

    protected function failedValidation(Validator $validator)
    {
        $messages = $this->processErrorMessage($validator->errors()->messages());
        dd($validator->errors()->messages());
        throw new HttpResponseException(response()->json($messages, $messages['http_status_code'])->header('Content-Type', 'application/json'));
    }

    private function processErrorMessage($message_data)
    {
        $messages = array_map(function ($node) {
            return $node[0];
        }, $message_data);

        return ResponseHelper::responseMaker(601, implode(PHP_EOL, $messages), null);
    }
}
