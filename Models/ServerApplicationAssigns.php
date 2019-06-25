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


class ServerApplicationAssigns extends \Jenssegers\Mongodb\Eloquent\Model implements
        AuthenticatableContract,
        AuthorizableContract,
        CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $collection = 'server_program_assigns';    


    protected $fillable = [
        '_id',
        'server_id',
        'program_id',
        'status',
        'created_at',
        'updated_at',
    ];

 

    public function getApplications() {
        return $this->hasOne('\App\Models\Application', '_id', 'program_id');
    }


    public function getServers() {
        return $this->hasOne('\App\Models\Server', '_id', 'server_id');
    }


    public function program() {
        return $this->hasOne('\App\Models\Application', '_id', 'program_id');
    }

}
