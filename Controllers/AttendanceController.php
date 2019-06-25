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
          $Id=$pieces[0].$pieces[1].$pieces[2].$pieces[3];
         print_r($Id);

          echo "<pre>";  
       }

            // print_r(array_keys($emp));
            //  foreach($all_employess as $all_employee){
            //        dd($emp['employees']);
            //       //  $val='27';
            //        $find_data=in_array($all_employee,$emp['employees']);
            //        dd($find_data);
            //   }
              
            // if(count($files)>0){
            // foreach($files as $value){
            // $arr[]=['name'=>$value[7].$value[8],'time'=>$value[12]];
            // dd($arr);
            // $Attendances=new Attendance();
            // $Attendances->employee_id      =$pieces[0];
            // $Attendances->punch_in         =$pieces[1];
            // $Attendances->punch_out        =$pieces[2];
            // $Attendances->created_at       =date("Y-m-d");
            // $Attendances->save();
            //  $res = mysql_query($sql);
  //         }
  // }
  
  // return "done";
        
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
        $rules = array('file' => 'max:6000|mimes:ods,xlsx,csv,txt');
        
        $validation = Validator::make($input, $rules);
        if ($validation->fails())
        {
          //  return Response::json('Please upload ods and xlsx format only', 400);
             $response = array('message' => 'Please upload ods and xlsx format only','alert-type' => 'error');
           return back()->with($response);
        }
        
          $uploadedFile = $request->file('file');
          $filename = $uploadedFile->getClientOriginalName().time();
          $destinationPath = public_path('/upload/attendance');
          $upload_success = $uploadedFile->move($destinationPath, $filename); 

          if($upload_success){
            $path=storage_path('upload/attendance',$filename);
            $file = fopen($path,"r"); 
            $files= fgetcsv($file);
            
            if(count($files)>0){
              foreach($files as $value){
                $arr[]=['name'=>$value];
                  
               

                  // $Attendances=new Attendance();
                  // $Attendances->employee_id   ="1";
                  // $Attendances->name          =$arr[0];
                  // $Attendances->punch_in      =$arr[2];
                  // $Attendances->punch_out     =$arr[3];
                  // $Attendances->total_hours   =$arr[4];
                  // $Attendances->total_days    =$arr[5];
                  // // $Attendances->over_time     =$arr[6];
                  // $Attendances->created_at    =date("Y-m-d");
                  // $Attendances->save();
              }
              return Response::json(in_array($value,$arr), 400);
              // return Response::json($arr, 200);       
          }
        return Response::json('success', 200);
      }else{
        return Response::json('error', 400);
      }
    }catch(\Exception $e){
    Log::error("There is something wrong ".$e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
    $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
    return back()->with($response);
  }
   }

   //for Get All punch in/out time start 
   public function listAttendance(Request $request)
   {
     try{
        $data=[];
        return view('attendance.list_attendance',$data);     

     }catch(\Expection $e){
      Log::error("There is something wrong ".$e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
      $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
      return back()->with($response);
     }
   }//for Get All punch in/out time end 
      
}
