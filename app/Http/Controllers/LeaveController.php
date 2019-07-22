<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log,DateTime;

//Models 
use App\Models\Company;
use App\Models\User;
use App\Models\Department;
use App\Models\leavesType;
use App\Models\leaveApply;
use App\Models\Attendance;
use App\Models\Holiday;

//Request 
use App\Http\Requests\LeaveApplyRequest;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class LeaveController extends Controller
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
     * View Add/Edit leave Page
     */
    public function addLeave(Request $request,$lId=null)
    {
      try{
            $data = [];
            $events=$this->getLeave();//call the function for get all Holiday && Week     
            $leavesTypes=leavesType::get();
            $data['leavesTypes']=$leavesTypes;
            $data['events']=$events;
            $session_users=Session::get('user');
            if($session_users['user']->getRole->name == 'Admin'){
               $apply_leaves=leaveApply::with('getLeaveType','getUserName')->where('status',true)->paginate(20);
            }elseif($session_users['user']->getRole->name == 'Manager'){ 
                $users=User::where('manager_Id',Auth::user()->id)->get();
             foreach($users as $user){
                $users_id[] = $user->id;
             }
             $apply_leaves=leaveApply::whereIn('user_Id',$users_id)->with('getLeaveType','getUserName')->where('status',true)->paginate(20);     
            //  return $apply_leaves;
            }else{
               $apply_leaves=leaveApply::where('user_Id',Auth::user()->id)->with('getLeaveType','getUserName')->where('status',true)->paginate(20);
            }
            $data['apply_leaves']=$apply_leaves;
            
            return view('leave.apply_post_leave',$data);
            }catch(\Exception $e){
                Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
                $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
                return back()->with($response);
            }
        }



    /**
     * For Add/edit apply leave
     */
     function postLeave(Request $request)
     {  
        // return $request->all();
       try{
            if($request->leaveOldId ==null){
                $leaveApply=new leaveApply();
                $leaveApply->created_at=date("Y-m-d");
                $message="leave Apply successfull.";
            }else{
                $user=leaveApply::where('_id',$request->leaveOldId)->first();
                $user->status=false;    
                $user->updated_at=date("Y-m-d");
                $user->save();

                $leaveApply=new leaveApply();
                $leaveApply->created_at=date("Y-m-d");
                $message="leave Apply successfull.";
            }

            $leaveApply->leave_type_Id       =$request->leave_Id;
            $leaveApply->user_Id             =Auth::user()->id;
            $leaveApply->leave_start_date    =$request->leaveStartDate;
            $leaveApply->leave_end_date      =$request->leaveEndDate;
            $leaveApply->total_days          =$request->total_days;
            $leaveApply->leave_reason        =$request->leave_reason;
            $leaveApply->phone               =$request->phone;
            $leaveApply->leave_status        ='Pending';
            $leaveApply->status              =true;
            $leaveApply->save();

            $response = array('message' => $message,'alert-type' => 'success');
            return back()->with($response);  

        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }

    /**
     * For view All Apply Leave List
     */
    public function listApplyLeave(Request $request)
    {
       try{
        $data=[];
        $session_users=Session::get('user');
        if($session_users['user']->getRole->name == 'Admin'){
            $apply_leaves=leaveApply::with('getLeaveType','getUserName')->get();
        }else{
            $apply_leaves=leaveApply::where('user_Id',Auth::user()->id)->with('getLeaveType','getUserName')->get();
        }
        
        $data['apply_leaves']=$apply_leaves;

        return view('leave.list_apply_leave',$data);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }

    
    /*
     * For leave Status Update or Approve
     */
    public function leaveStatusUpdate(Request $request,$leaveId,$leaveType)
    {
      try{
          $apply_leaves=leaveApply::where('_id',$leaveId)->first(); 
                $apply_leaves->leave_status           =$leaveType;
                $apply_leaves->authority_Id           =Auth::user()->id;
                $apply_leaves->authority_created_at   =date("Y-m-d");
                $apply_leaves->save();  

           $response = array('message' => "successfull updated.",'type' => 'success');
           return $response; 
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            return Response::json([
                'error_message' => 'There is something wrong. Please contact administrator.'.$e->getMessage(),
                'error'=> true,
            ]);
        }
    }


    //For get all leave 
    public function getLeave()
    {   
      try{
        $session_users=Session::get('user');
        if($session_users['user']->getRole->name != 'Admin'){
            $leaveApplylist2 = $this->getAttendance();
            $leaveApplylist3 = $this->offDaysCalculation();
            $leaveApplylist=array_merge($leaveApplylist2,$leaveApplylist3);
        }

        $leaveApplys=leaveApply::with('getLeaveType')->where('user_Id',Auth::user()->id)->where('status',true)->get();
            if(count($leaveApplys)){
                foreach($leaveApplys as $leaveApply){
                    $leaveApplylist[] = array("title"=> $leaveApply->getLeaveType->leave_name, "start"=>$leaveApply->leave_start_date, "end"=>$leaveApply->leave_end_date."T23:59:00", "className"=>$leaveApply->leave_status,"id"=>$leaveApply->_id,"leave_reason"=>$leaveApply->leave_reason, "description"=> $leaveApply->leave_reason,"phone"=> $leaveApply->phone,"leave_type_Id"=>$leaveApply->leave_type_Id);
                }
            }
            //for get all user data
            $holidays=Holiday::get();
            foreach($holidays as $holiday){
                $leaveApplylist[] =array("title"=>$holiday->holiday_label,"start"=>$holiday->holiday_date,"id"=>$holiday->_id,"holiday_id"=>$holiday->holiday_id,"className"=>"holiday");  
            }
            return Response::json(["events" => $leaveApplylist]);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }//end get leve function

    //For get all attendance
    public function getAttendance()
    {
        $data=[];
        $user_code=Auth::user()->user_code;
        $attendance=Attendance::getAttendanceById($user_code);
        return $attendance;
    }

    //for delete leave
    public function deleteLeave($id)
    {
        try{
            $leaveData=leaveApply::where('_id',$id)->first();
            $leaveData->status =false; 
            $leaveData->authority_Id =Auth::user()->id;
            $leaveData->authority_updated_at =date("Y-m-d");
            $leaveData->save();  
            $message="Leave Successfull Deleted."; 
            $response = array('message' => $message,'alert-type' => 'success');
            return Response::json(["response" => $response]);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }

    //for get all saturday with off
    public function offDaysCalculation(){
       $months=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
       $users=User::where('_id',Auth::user()->id)->with('userDepartments')->first();
       $company_details=Company::where('_id',$users->userDepartments->company_Id)->pluck('shifts')->first();
       foreach($months as  $month)
        { 
           $total_days = cal_days_in_month(CAL_GREGORIAN, $month, 2019);  
            if($total_days >= 29){
               $date = 29;
                $is_saturday = 0;
                    for($date=29; $date<=$total_days; $date++){
                        $datetime = "2019-".$month.'-'.''.$date;
                        $day = date('l', strtotime($datetime));
                        //echo $day. " - ".$datetime."<br>";
                        if($day == 'Saturday'){
                            if($date == '29'){
                                $is_saturday=1;
                            }else if($date == '30'){
                                $is_saturday=1;
                            }else if($date == '31'){
                                $is_saturday=1;   
                            }
                        }
                    }
                }
            foreach($company_details as $key =>  $shift)
            {     
              if($shift == "n"){
                    switch($key){
                    case($key =="1_Saturday"):
                        $date=date("Y-m-d", strtotime("first saturday 2019-".''.$month));
                        $leaveApplylist[]=array("title"=>"First Saturday","start"=>$date,"className"=>"week_off");
                    break;
                    case($key =="2_Saturday"):
                        $date=date("Y-m-d", strtotime("second saturday 2019-".''.$month));
                        $leaveApplylist[]=array("title"=>"Second saturday off","start"=>$date,"className"=>"week_off");
                    break;
                    case($key =="3_Saturday"):
                        $date=date("Y-m-d", strtotime("third saturday 2019-".''.$month));
                        $leaveApplylist[]=array("title"=>"Third saturday off","start"=>$date,"className"=>"week_off");
                    break;
                    case($key =="4_Saturday"):
                        $date=date("Y-m-d", strtotime("fourth saturday 2019-".''.$month));
                        $leaveApplylist[]=array("title"=>"Fourth saturday off","start"=>$date,"className"=>"week_off");
                    break;
                    case($key =="5_Saturday"):
                        if($is_saturday == '1'){
                            $date=date("Y-m-d", strtotime("fifth saturday 2019-".''.$month));
                            $leaveApplylist[]=array("title"=>"Five saturday off","start"=>$date,"className"=>"week_off");
                        }
                    break;
                     }
                  }
               }
            }
            return $leaveApplylist;
    }//end function



}
