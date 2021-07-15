<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:01
 */

namespace App\Http\Controllers\Notification;

#custom use
use App\Http\Controllers\BaseForm;

class Form extends BaseForm
{
    public function rules()
    {
        $identifier = $this->getFunctionIdentifier();
        switch ($identifier) {
            case "index":
                $different_rules = [
                    'user_id'       =>  'required|integer|min:1',       // 覆寫 default rule
                    'department_id' =>  'required|integer|min:1',       // 新增 rule
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
}
