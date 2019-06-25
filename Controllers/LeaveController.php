<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log;

//Models 
use App\Models\Company;
use App\Models\User;
use App\Models\Department;
use App\Models\leavesType;
use App\Models\leaveApply;
use App\Models\Attendance;

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
          //   $leaveApplys=leaveApply::with('getLeaveType')->where('user_Id',Auth::user()->id)->get();
          $events=$this->getLeave();
          $leavesTypes=leavesType::get();
          $data['leavesTypes']=$leavesTypes;
          $data['events']=$events;

          if($lId !=null){
          $leaveApply=leaveApply::where('_id',$lId)->first();
             $data['leaveApply']=$leaveApply;
          }


        $session_users=Session::get('user');
        if($session_users['user']->getRole->name == 'Admin'){
           $apply_leaves=leaveApply::with('getLeaveType','getUserName')->where('status',true)->get();
        }else{
           $apply_leaves=leaveApply::where('user_Id',Auth::user()->id)->with('getLeaveType','getUserName')->where('status',true)->get();
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
       $leaveApplys=leaveApply::with('getLeaveType')->where('user_Id',Auth::user()->id)->where('status',true)->get();
          if(count($leaveApplys)){
            foreach($leaveApplys as $leaveApply){
                $leaveApplylist[] = array("title"=> $leaveApply->getLeaveType->leave_name, "start"=>$leaveApply->leave_start_date, "end"=>$leaveApply->leave_end_date."T23:59:00", "className"=>$leaveApply->leave_status,"id"=>$leaveApply->_id,"leave_reason"=>$leaveApply->leave_reason, "description"=> $leaveApply->leave_reason,"phone"=> $leaveApply->phone,"leave_type_Id"=>$leaveApply->leave_type_Id);
               }
          }else{
            $leaveApplylist =0;
          } 

            return Response::json(["events" => $leaveApplylist]);
    }catch(\Exception $e){
        Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
        $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
        return back()->with($response)->withInput();
    }
    }//end get leve function




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



}

