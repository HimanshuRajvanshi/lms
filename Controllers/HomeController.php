<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log;

use App\Models\User;

class HomeController extends Controller
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
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */
    public function index(Request $request)
    {
        try{
           $data=[];
           $user=User::with('getRole','userDepartments')->where('_id',Auth::id())->first();
            if($user->getRole != null){
                $data['user']=$user;
                Session()->put('user',$data);
                return view('home');
            }else{
                //when user don't have role
                Auth::logout();
                $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
                return back()->with($response);
            }

        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }




}
