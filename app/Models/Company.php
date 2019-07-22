<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Company extends \Jenssegers\Mongodb\Eloquent\Model implements
        AuthenticatableContract,
        AuthorizableContract,
        CanResetPasswordContract
{
    
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $collection = 'company';



    protected $fillable = [
        'company_id',
        'company_name',
        'gst_number',
        'address',
        'is_head_quarter',
    ];


    public function departments()
    {
        return $this->belongsTo('\App\Models\Department','company_id');
    }



}
