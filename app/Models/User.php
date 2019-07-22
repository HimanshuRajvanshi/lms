<?php
namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;


class User extends \Jenssegers\Mongodb\Eloquent\Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    
    protected $collection = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email',
        'password',
        'department_Id',
        'first_name',
        'last_name',
        'user_code',
        'name',
        'date_of_join',
        'gender',
        'contact_number',
        'emergency_number',
        'designation',
        'present_address',
        'permanent_address',
        'photo',
        'user_status',
        'is_status',
        'role_Id',
        'manager_Id',    
    ];
       
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * For get User Department details
     */
    public function userDepartments(){
        return $this->belongsTo('\App\Models\Department','department_Id');
    }

    public function getRole(){
        return $this->belongsTo('\App\Models\Roles','role_Id');
    }

    public function getLeave() {
        return $this->belongsTo('\App\Models\leaveApply', 'user_Id');
    }

    public function getTeam() {
        return $this->hasMany('\App\Models\User', 'manager_Id');
    }
}
