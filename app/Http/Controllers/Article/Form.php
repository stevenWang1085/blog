<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:01
 */

namespace App\Http\Controllers\Article;

#custom use
use App\Http\Controllers\BaseForm;

class Form extends BaseForm
{
    public function rules()
    {
        $identifier = $this->getFunctionIdentifier();
        switch ($identifier) {
            case "store":
                $different_rules = [
                    'board_id' => 'required|integer',
                    'title'    => 'required|string|min:1',
                    'content'  => 'required|string|min:3'
                ];
                break;
            case "update":
                $different_rules = [
                    'article'  => 'required|nullable',
                    'title'    => 'required|string|min:1',
                    'content'  => 'required|string|min:3'
                ];
                break;
            case "destroy":
                $different_rules = [
                    'article'  => 'required|nullable',
                ];
                break;
            case "updateFavor":
                $different_rules = [
                    'id'  => 'required|nullable',
                ];
                break;
            default:
                $different_rules = [];
                break;
        }

        return $different_rules;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function all($keys = null)
    {
        return array_merge(parent::all(), $this->route()->parameters());
    }

    public function messages()
    {
        return [
            'required'    => ':attribute為必填。',
            'title.min'   => ':attribute長度需大於1位字元。',
            'content.min' => ":attribute長度需大於3位字元",
        ];
    }

    public function attributes()
    {
        return [
            'title'   => '標題',
            'content' => '內容'
        ];
    }
}
