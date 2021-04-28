<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:01
 */

namespace App\Http\Controllers\ArticleComment;

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
                    'article_id' => 'required|integer|nullable',
                    'comment'    => 'required|string|min:1'
                ];
                break;
            case "update":
                $different_rules = [
                    'comment_id' => 'required|integer|nullable',
                    'comment'    => 'required|string|min:1'
                ];
                break;
            case "destroy":
                $different_rules = [
                    'comment_id' => 'required|integer|nullable',
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
            'comment.min' => ':attribute長度需大於1位字元。',
        ];
    }

    public function attributes()
    {
        return [
            'comment'    => '留言內容',
            'article_id' => '文章編號',
            'comment_id' => '留言編號'
        ];
    }
}
