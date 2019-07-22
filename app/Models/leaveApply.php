<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class leaveApply extends \Jenssegers\Mongodb\Eloquent\Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{

use Authenticatable, Authorizable, CanResetPassword, Notifiable;
protected $collection = 'leave_apply';
    

    protected $fillable = [
        'leave_list_Id',
        'user_Id',
        'leave_start_date',
        'leave_end_date',
        'total_days',
        'leave_reason',
        'total_days',
        'phone',
        'leave_status',
        'status',
        'authority_Id',
        'authority_updated_at',
        'created_at',
        'updated_at',
    ];



    public function getLeaveType() {
        return $this->belongsTo('\App\Models\leavesType', 'leave_type_Id');
    }

    public function getUserName() {
        return $this->belongsTo('\App\Models\User', 'user_Id');
    }



}
