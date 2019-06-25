<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class leavesType extends \Jenssegers\Mongodb\Eloquent\Model implements
        AuthenticatableContract,
        AuthorizableContract,
        CanResetPasswordContract
{
    
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $collection = 'leaves_types';



    protected $fillable = [
        'leave_type_Id',
        'leave_name',
        'leave_description',
        'status',
    ];

}
