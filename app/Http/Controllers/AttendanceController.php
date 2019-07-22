<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log,Storage;

//Models 
use App\Models\Company;
use App\Models\User;
use App\Models\Department;
use App\Models\Roles;
use App\Models\Events;
use App\Models\Attendance;
use App\Models\leaveApply;
use Hamcrest\Arrays\IsArray;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


      /**
       * For Single User Profile View
       */
      public function index(Request $request)
      {
       $user=Session::get('user');
       $departments=Department::where('company_Id',$user['user']->userDepartments->company_Id)->pluck('_id');
       $all_employess=User::WhereIn('department_Id',$departments)->pluck('_id');

       $path=storage_path('app/public/attlog.txt');
       $file = fopen($path,"r"); 
       $count = 0;
       //$emp=array();

       while(! feof($file))
       {
         $count = $count+1;
         $test = fgets($file);
         $a = $test;
         $pieces = explode("  ", $a);
         $new_pieces[] = (trim(end($pieces)));
        }

       array_pop($new_pieces);
       foreach($new_pieces as $pieces){
        echo "<pre>";  
          $Data=str_replace("	"," ",$pieces);//copy past from the attendance file
          $newData = explode(' ', $Data);
          $asd[] = array('user_id'=>$newData[0], 'date'=>$newData[1], 'time'=>$newData[2]);
        //  print_r($newData);
      }

      $user_id = $asd[0]['user_id'];
      $date = $asd[0]['date'];
      $user_array = array();
      foreach($asd as $zxc){
        
        if($zxc['date'] == $date){
          if(!in_array($zxc['user_id'], $user_array)){
            // echo $zxc['user_id']." insert date ".$zxc['date']." and time ". $zxc['date']$zxc['date']."<br>"; 

            $Attendances=new Attendance();
            $Attendances->employee_id      =$zxc['user_id'];
            $Attendances->start_date       =$zxc['date'];
            $Attendances->punch_in         =$zxc['time'];
            $Attendances->created_at       =date("Y-m-d");
            $Attendances->save();

          }else{
            // echo $zxc['user_id']." out date ".$zxc['date']." and time ". $zxc['time']."<br>"; 
            $Attendances=Attendance::where('employee_id',$zxc['user_id'])->orwhere('start_date',$zxc['date'])->first();   
            $Attendances->punch_out         =$zxc['time'];
            $Attendances->created_at       =date("Y-m-d");
            $Attendances->save();
          }
          
          $user_array[] = $zxc['user_id'];
        }else{
          unset($user_array);
          $user_array = array();
        }
 

        $date = $zxc['date'];

        
        //$user_id = $zxc['user_id'];
        }

        $response = array('message' => "Record Save Successfull",'alert-type' => 'success');
        return back()->with($response); 

      }//end index function




     /*
       **For Upload Attendance
      */
      public function uploadAttendance(Request $request)
      {
       try{
          return view('attendance.post_upload_attendance');   
        }catch(\Exception $e){
          Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
          $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
          return back()->with($response)->withInput();
        }    
      }

      /**
       *For upload attendance file into DB
      **/
      public function postUploadAttendance(Request $request)
      {  
        try{
        $input = Input::all();
        $rules = array('file' => 'max:6000|mimes:txt');
        
        $validation = Validator::make($input, $rules);
        if ($validation->fails())
        {
          //  return Response::json('Please upload ods and xlsx format only', 400);
             $response = array('message' => 'Please upload ods and xlsx format only','alert-type' => 'error');
           return back()->with($response);
        }
        
        $uploadedFile = $request->file('file');
        $filename = $uploadedFile->getClientOriginalName().time();
        $destinationPath = storage_path('/app/public/upload/attendance');
        $upload_success = $uploadedFile->move($destinationPath, $filename); 

        if($upload_success){
          $path=storage_path('/app/public/upload/attendance/'.$filename);
          $file = fopen($path,"r"); 
          $count = 0;
          while(! feof($file))
          {
            $count = $count+1;
            $test = fgets($file);
            $a = $test;
            $pieces = explode("  ", $a);
            $new_pieces[] = (trim(end($pieces)));
           }
   
          array_pop($new_pieces);
          foreach($new_pieces as $pieces){
           echo "<pre>";  
             $Data=str_replace("	"," ",$pieces);//copy past from the attendance file
             $newData = explode(' ', $Data);
             $asd[] = array('user_id'=>$newData[0], 'date'=>$newData[1], 'time'=>$newData[2]);
           //  print_r($newData);
         }
   
         $user_id = $asd[0]['user_id'];
         $date = $asd[0]['date'];
         $user_array = array();
         foreach($asd as $zxc){
           
           if($zxc['date'] == $date){
             if(!in_array($zxc['user_id'], $user_array)){
              //  echo $zxc['user_id']." in date ".$zxc['date']." and time ". $zxc['time']."<br>"; 
   
               $Attendances=new Attendance();
               $Attendances->employee_id      ='TS/'.$zxc['user_id'];
               $Attendances->start_date       =$zxc['date'];
               $Attendances->punch_in         =$zxc['time'];
               $Attendances->file_name        =$filename;
               $Attendances->created_at       =date("Y-m-d");
               $Attendances->save();
   
             }else{
              //  echo $zxc['user_id']." out date ".$zxc['date']." and time ". $zxc['time']."<br>"; 
               $Attendances=Attendance::where('employee_id','TS/'.$zxc['user_id'])->where('start_date',$zxc['date'])->first();   
               //for extra hours get
                $start = strtotime($Attendances->punch_in);
                $end = strtotime($zxc['time']);
                $hours = $end- $start;
                $total_hours=gmdate("H:i:s", $hours);
                
                //for update data
               $Attendances->punch_out        =$zxc['time'];
               $Attendances->total_hours      =$total_hours;
               $Attendances->created_at       =date("Y-m-d");
               $Attendances->save();
             }
             
             $user_array[] = $zxc['user_id'];
           }else{
             unset($user_array);
             $user_array = array();
           }
             $date = $zxc['date'];
           }
            $response = array('message' => "Record Save Successfull",'alert-type' => 'success');
            return back()->with($response); 
         } 

      }catch(\Exception $e){
      Log::error("There is something wrong ".$zxc['user_id'].$e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
      $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
      return back()->with($response);
    }
  }

   //for Get All punch in/out data 
   public function listAttendance(Request $request)
   {
     try{
        $user_code=Auth::user()->user_code;
        $data['attendances']=Attendance::getAttendanceById($user_code);
        return view('attendance.list_attendance',$data);     
     }catch(\Expection $e){
      Log::error("There is something wrong ".$e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
      $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
      return back()->with($response);
     }
   }//for Get All punch in/out time details 

   
   //For edit punch in/out time start
   public function postPunchTime(Request $request)
   {
    try{
      // return $request->all();
      if($request->attendanceId == null){
        $attendances=new Attendance();
        $attendances->start_date=$request->start_date;
        $attendances->employee_id=$request->employeeId;
      }else{
        $attendances=Attendance::where('_id',$request->attendanceId)->first();
      }

        //for time 
        $start = strtotime($request->punch_in);
        $end = strtotime($request->punch_out);
        $hours = $end- $start;
        $total_hours=gmdate("H:i:s", $hours);
      
      $attendances->punch_in=$request->punch_in;
      $attendances->punch_out=$request->punch_out;
      $attendances->authority_id=Auth::id();
      $attendances->authority_created_at=date("Y-m-d");
      $attendances->save();

      $response = array('message' => "Record Save Successfull",'alert-type' => 'success');
      return back()->with($response); 

    }catch(\Expection $e){
      Log::error("There is something wrong ".$e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
      $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
      return back()->with($response);
     } 
   }//For edit punch in/out time end

   

   
}
