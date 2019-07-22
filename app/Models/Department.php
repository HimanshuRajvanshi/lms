<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Department extends \Jenssegers\Mongodb\Eloquent\Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{

use Authenticatable, Authorizable, CanResetPassword, Notifiable;
protected $collection = 'department';
    

    protected $fillable = [
        'department_id',
        'company_Id',
        'department_name',
        'location',
        'address',
        'status',
    ];


    public function getDepartment() {
        return $this->belongsTo('\App\Models\Company', 'company_Id');
    }


}
