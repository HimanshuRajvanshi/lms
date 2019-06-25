<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log;

//Models 
use App\Models\Company;
use App\Models\Department;

//Request
use App\Http\Requests\AddDepartmentRequest;



class DepartmentController extends Controller
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
     * For View Department of company.
     */
    public function addDepartment(Request $request,$id=null)
    {
        try{
            $data=[];
            $companys=Company::get();                
            $data['companys']=$companys;
            if($id != null){
                $department=Department::Where('_id',$id)->first();
                $data['department']=$department;
                $data['btn']="Update";
                $data['txt']="Edit";
            }else{
                $data['btn']="Save";
                $data['txt']="Add";
            }
            return view('department.post_department',$data);

        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        } 
    }



   /* 
    *For Add/Edit Department    
    */
    public function postDepartment(AddDepartmentRequest $request)
    {
      try{
        //  return $request->all();  
         if($request->departmentId ==null){
              $department=new Department();  
              $message="Department successfull added. ";
         }else{
            $department=Department::where('_id',$request->departmentId)->first();   
            $message="Department successfull update. ";    
         }  

         $department->company_Id         =$request->comany_id;
         $department->department_name    =$request->department_name;
         $department->location           =$request->location; 
         $department->address            =$request->address;
         $department->status             ="Active";
         $department->save();
 
         $response = array('message' => $message,'alert-type' => 'success');
         return back()->with($response);        

         }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }
    


    /**
     * For all department list 
     */
    public function listsDepartment(Request $request)
    {
      try{
        $data=[];
        $departments=Department::get();
        $data['departments']=$departments;
        return view('department.list_department',$data);
        }
            catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        } 
    }


    


}
