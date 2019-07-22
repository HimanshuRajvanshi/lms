<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,log;

//Models 
use App\Models\Company;
use App\Models\Department;

//Request 
use App\Http\Requests\AddCompanyRequest;


class CompanyController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     */
    public function postCompany(Request $request,$id=null)
    {
        try{
            $data=[];
            if($id != null){
                $company=Company::Where('_id',$id)->first();
                $data['company']=$company;
                $data['btn']="Update";
                $data['txt']="Edit";
            }else{
                $data['btn']="Save";
                $data['txt']="Add";
            }
            return view('company.post_company',$data);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        } 
    }

    /**
     * For Add/Edit Company Details
     */
    public function postSaveCompany(AddCompanyRequest $request)
    {
      try{  
          if($request->cId ==null){
             $company=new Company();  
             $company->created_at =date("Y-m-d");
             $message="Company successfull added.";

            }else{
                $company=Company::where('_id',$request->cId)->first();   
                $company->updated_at =date("Y-m-d");
                $message="Company successfull update.";
            }
            $company->company_name       =$request->company_name;
            $company->gst_number         =$request->gst_number;
            $company->address            =$request->address;
            $company->is_head_quarter    =$request->is_head_quarter; 
            $company->save();

            $response = array('message' => $message,'alert-type' => 'success');
            return back()->with($response);    
        
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }

    /**
     * for List all Company function
     */
    public function listsCompany(Request $request)
    {
        try{
            $data=[];
            $companys=Company::get();
            $data['companys']=$companys;
            return view('company.list_company',$data);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }

    /*
     *for list all company department
    */
    public function viewCompanyDepartment(Request $request,$id)
    {
     try{
        $data=[];
        $departments=Department::where('company_Id',$id)->with('getDepartment')->get();  
        $data['departments']=$departments;
        return view('company.list_company_department',$data);
     }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }







    
}
