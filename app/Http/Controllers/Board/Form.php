<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:01
 */

namespace App\Http\Controllers\Board;

use App\Http\Controllers\BaseForm;

class Form extends BaseForm
{
    public function rules()
    {
        switch ($this->method_name) {
            case "store":
                $different_rules = [
                    'name' => 'required|min:1|unique:boards',
                    'memo' => 'required|min:1'
                ];
                break;
            case "update":
                $different_rules = [
                    'name' => [
                        'required',
                        'min:1',
                        'unique:boards,name,'.$this->board
                    ],
                    'memo' => 'required|min:1'
                ];
                break;
            case "destroy":
                $different_rules = [
                    'board' => 'required|nullable'
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
            'required'     => ':attribute為必填。',
            'min'          => ':attribute長度需大於1位字元。',
            'name.unique'  => "看板已存在，請更換。",
        ];
    }

    public function attributes()
    {
        return [
            'name' => '名稱',
            'memo' => '備註'
        ];
    }
}
