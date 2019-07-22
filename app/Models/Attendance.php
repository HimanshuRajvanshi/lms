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
        'file_name',
        'over_time',
        'start_date',
        'end_date',
        'status',
        'created_at',
        'updated_at'
    ];


    //for get all employee details by employee Id
    protected function getAttendanceById($user_code)
    { 
      $data=[];
       $attendances =Attendance::where('employee_id',$user_code)->get();
        if(count($attendances)){
          foreach($attendances as $attendance){
            if(strtotime($attendance->total_hours) < strtotime("6:00:00")){
              $pha = "[H]";  
            }else{
              $pha = "[P]";  
            }
            if($attendance->total_hours == null){
              $attendance->total_hours=0;
            }

            $new_attendances[] = array("title"=>"In ". $attendance->punch_in.' - '."Out ".$attendance->punch_out , "start"=>$attendance->start_date, "end"=>$attendance->start_date, "id"=>$attendance->_id,"total_hours"=>$attendance->total_hours, "description"=>$pha.' total Time '.$attendance->total_hours,"attendance_status"=> $pha,"className"=>"attendance");
           }
        }else{
          $new_attendances =0;
        } 
        
        return $new_attendances;
    }



}
