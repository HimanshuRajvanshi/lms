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


class Attendance extends \Jenssegers\Mongodb\Eloquent\Model implements
        AuthenticatableContract,
        AuthorizableContract,
        CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    protected $collection = 'attendances';    


    protected $fillable = 
    [
        'employee_id',
        'name',
        'punch_in',
        'punch_out',
        'total_hours',
        'total_days',
        'over_time',
        'start_date',
        'end_date',
        'status',
        'created_at',
        'updated_at'
    ];

}
