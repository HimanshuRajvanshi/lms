<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log;

//Models 
use App\Models\Company;
use App\Models\User;
use App\Models\Department;
use App\Models\Roles;

//Request 
use App\Http\Requests;

class UserController extends Controller
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
     * For Add/Edit Company Details
     */
    public function addUserPage(Request $request)
    {
       try{
           $data=[];
           $user=User::where('_id','5c8117483b77507dd00f3602')->first();
           $departments=Department::get();
           $roles=Roles::where('status','Active')->get();
           $data['user']=$user;
           $data['departments']=$departments;
           $data['roles']=$roles;
           $data['button']='Save';
           $data['header_txt']='Add User';
           return view('user.post_user',$data);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }



    /**
     * For Add/Edit Company Details
     */
    public function postSaveCompany(Request $request)
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
            return back()->with($response);
        }
    }
    


    /**
     * For Add/edit user information
     */
    public function postUser(Requests\AddUserRequest $request)
    {
       try{
            // return $request->all();
            if($request->user_Id ==null){
                $user=new User();
                $user->email=$request->email;
                $user->password=Hash::make($request->password);
                $user->create_at=date("Y-m-d");
                $message="User successfull add.";
                
            }else{
                $user=User::where('_id',$request->user_Id)->first();
                $user->updated_at=date("Y-m-d");
                $message="User successfull updated.";
            }

            $user->department_Id        =$request->department_Id;
            $user->user_code            =$request->user_code;
            $user->first_name           =$request->first_name;
            $user->last_name            =$request->last_name;
            $user->name                 =ucwords($request->first_name)." ".ucwords($request->last_name);
            $user->date_of_join         =$request->date_of_join;
            $user->gender               =$request->gender;
            $user->date_of_birth        =$request->date_of_birth;
            $user->contact_number       =$request->contact_number;
            $user->emergency_number     =$request->emergency_number;
            $user->designation          =$request->designation;
            $user->present_address      =$request->present_address;
            $user->permanent_address    =$request->permanent_address;
            $user->photo                =$request->photo;
            $user->user_status          =$request->user_status;
            $user->is_status            ="Active";
            $user->role_Id              =$request->role_id;
            $user->save();

            $response = array('message' => $message,'alert-type' => 'success');
            return back()->with($response);  
            
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }



      /**
       * For All User List show here
      */ 
      public function listUser(Request $request)
      {
         try{
            $data=[]; 
            $users=User::with('userDepartments')->get();
            $data['users']=$users;
            return view('user.list_user',$data);
          }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
          }
      }


      /**
       * For Single User Profile View
       */
      public function userProfileView(Request $request,$user_Id)
      {
        // return $user_Id;
        try{
            $data=[];
            $user=User::where('_id',base64_decode($user_Id))->first();
            $data['user']=$user;

            return view('user.view_user',$data);

        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
      }






      
}
