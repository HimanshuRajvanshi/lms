<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log;

//Models 
use App\Models\Company;
use App\Models\User;
use App\Models\Department;


class RoleController extends Controller
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

    

    /***
     * For Add Role
     */
    public function addRole(Request $request)
    {
        return back();
          //return "demo";
    }

    /**
     * this is functuib deni                      
     */
    public function Demo(Request $request)
    {
        
    }
    //PURCHASE SUBJECT: MCUPOS 18MAR1159 Card no.: 5497XXX2XXXX5505 18MAR19 115918 INSTAKART SERVICES PVT\Khasra Ref: 031800000451
      
}
