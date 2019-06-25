<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class ServerLog extends \Jenssegers\Mongodb\Eloquent\Model implements
        AuthenticatableContract,
        AuthorizableContract,
        CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $collection = 'server_logs';    

    protected $casts = [
        'server_down_at'  =>'datetime',
        'server_up_at'    =>'datetime',
    ];

    protected $fillable = [
        'server_id',
        'status',
        'log_status',
        'server_down_at',
        'server_up_at',
        'server_total_down_time'
        ,'created_at'
        ,'updated_at'
    ];

 
    public function getServer() {
        return $this->belongsTo('\App\Models\Server', '_id');
    }

}
