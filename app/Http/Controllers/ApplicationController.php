<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML,Form,Validator,Mail,Response,Session,Auth,DB,Redirect,Image,Password,Cookie,File,View,Hash,JsValidator,URL,Notification,Log;

//Models
use App\Models\User;
use App\Models\Server;
use App\Models\ServerLog;
use App\Models\Application;
use App\Models\ServerProgramLog;
use App\Models\ServerApplicationAssigns;


use App\Http\Requests\AddProgramRequest;

class ApplicationController extends Controller
{
    /**
     * Program Save
     */
    public function saveProgram(Request $request)
    {
        try{

            $message="Program successfully.";
            $description = $request->input('description');
            $servers = $request->input('server');
            
            $Application                =new Application();
            $Application->name          =$request->input('program_namea');
            $Application->type          =$request->input('type');
            $Application->environment   =$request->input('environment');
            $Application->description   =str_replace('/','-',$description);
            $Application->save();

            if(!empty($servers)){
                foreach($servers as $server){
                    $last_status = ServerApplicationAssigns::where('server_id', $server)->where('program_id', $request->program_id)->update(['status' => false]);
                    $ServerApplicationAssigns                      =new ServerApplicationAssigns();
                    $ServerApplicationAssigns->server_id           =$server;
                    $ServerApplicationAssigns->program_id          =$Application->_id;
                    $ServerApplicationAssigns->status              =true;
                    $ServerApplicationAssigns->save();
                }
            }
            
            $response = array('message' => $message,'alert-type' => 'success');
            return back()->with($response);  

        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
             $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }
    
    
    /*
      *For all Program List
    */
    public function ProgramList(Request $request)
    {
        try{ 
            $data=[];
            $servers=Server::get();
            $programs=Application::paginate(20);
            $data['programs']=$programs;
            $data['servers']=$servers;
            return view('program.program_list',$data);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }


    /*
      *Fetch all Server List by program id
    */
    public function getServerListByProgramId(Request $request)
    {
        
        try{ 
            $data=[];
            $servers=Server::get();
            
            $app_servers= ServerApplicationAssigns::where('program_id', $request->program_id)->where('status', true)->get()->pluck('server_id');
            $app_servers= $app_servers->all();
            $program=Application::where('_id',$request->program_id)->first();
            
            $data['servers']=$servers;
            $data['app_servers']=$app_servers;
            $data['program_id']=$request->program_id;
            $data['program_name']=$program->name;
            $data['type']=$program->type;
            $data['description']=$program->description;
            $data['environment']=$program->environment;

            return view('program.server_assign_modal',$data);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }

    
    /**
     * Assign Server to Program Save data
     */
    public function assignServerProgram(Request $request)
    {
        // return $request->all();
        try{
            $message="Server assign successfully.";
            $servers = $request->input('server');
            $last_status = ServerApplicationAssigns::where('program_id', $request->program_id)->update(['status' => false]);
            if(!empty($servers)){
                foreach($servers as $server){
                    $ServerApplicationAssigns                      =new ServerApplicationAssigns();
                    $ServerApplicationAssigns->server_id           =$server;
                    $ServerApplicationAssigns->program_id          =$request->program_id;
                    $ServerApplicationAssigns->status              =true;
                    $ServerApplicationAssigns->save();
                }
            }
            else{
                $last_status = ServerApplicationAssigns::where('program_id', $request->program_id)->update(['status' => false]);
            }

            //for update program details
            $application = Application::where('_id', $request->program_id)->update([
                'name'             =>$request->program_name,
                'description'      =>str_replace('/','-',$request->description),
                'type'             =>$request->type,
                'environment'      =>$request->environment
                ]);

            $response = array('message' => $message,'alert-type' => 'success');
            return back()->with($response);  

        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }


    /*
      *For all Program List
    */
    public function getServerByProgramId(Request $request, $program_id)
    {
        try{ 
            $data=[];
            $servers=ServerApplicationAssigns::where('program_id', $program_id)->where('status', true)->with('getServers')->get();
            $data=$servers;
            return response()->json(['data'=>$data]);
        }catch(\Exception $e){
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }




}//end Application Controller
