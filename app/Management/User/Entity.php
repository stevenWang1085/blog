<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/11/15
 * Time: 下午5:06
 */

namespace App\Management\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class Entity extends Model
{

    use Notifiable;
//    use Notifiable {
//        notify as protected laravelNotify;
//    }
//
//    public function notify($instance)
//    {
//        if($this->id == Auth::id()) {
//            return;
//        }
//        $this->increment('notification_count');
//        $this->laravelNotify($instance);
//    }

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
    ];

    protected $hidden = [
        'password',
        'reset_password_code',
        'reset_password_limit_time'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
