<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HTML, Form, Validator, Mail, Response, Session, Auth, DB, Redirect, Image, Password, Cookie, File, View, Hash, JsValidator, URL, Notification, Log;

//Models
use App\Models\User;
use App\Models\Server;
use App\Models\ServerLog;
use App\Models\Application;
use App\Models\ServerProgramLog;
use App\Models\ServerApplicationAssigns;
use Carbon\Carbon;



class ServerController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['externalIncidentList']]);
    }



    /**
     *For all Server List
     */
    public function serverList(Request $request)
    {
        try {
            $data = [];
            $servers = Server::get();
            foreach ($servers as $server) {
                $serverLog = ServerLog::where("server_id" == $server->_id)->latest()->first();
                $serverData[] = array(
                    'server_id' => $server->_id, 'server_name' => $server->name, 'server_type' => $server->type,
                    'server_status' => $serverLog->status, 'server_down_at' => $serverLog->server_down_at,
                    'server_up_at' => $serverLog->server_up_at, 'server_total_down_time' => $serverLog->server_total_down_time
                );
            }

            $data['servers'] = $serverData;
            return view('server.server_list', $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }


    /**
     * For Add Server program log add/Edit
     */
    public function serverProgramLog(Request $request)
    {
        try {
            $data = [];
            $servers = Server::get();
            $programs = Application::get();

            $data['txt'] = 'Add';
            $data['btn'] = 'Save';
            $data['servers'] = $servers;
            $data['programs'] = $programs;
            return view('server.post_server_log', $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }


    /**
     * Server Program Log Save
     */
    public function postServerProgramLog(Request $request)
    {
        try {
            $message = "Application Log submitted successfully.";
            $last_status = ServerProgramLog::where('server_id', $request->server_id)->where('program_id', $request->program_id)->update(['incident_status' => false]);

            $serverProgramLogs                      = new ServerProgramLog();
            $serverProgramLogs->server_id           = $request->server_id;
            $serverProgramLogs->program_id          = $request->program_id;
            $serverProgramLogs->impact              = $request->impact;
            $serverProgramLogs->reason              = $request->reason;
            $serverProgramLogs->app_down_time       = $request->app_down_time;
            $serverProgramLogs->expected_up_time    = $request->expected_up_time;
            $serverProgramLogs->remarks             = $request->remarks;
            $serverProgramLogs->created_by          = 1;
            $serverProgramLogs->updated_by          = 1;
            $serverProgramLogs->incident_status     = true;
            $serverProgramLogs->save();

            $response = array('message' => $message, 'alert-type' => 'success');
            return back()->with($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }

    public function editServerProgramLog(Request $request)
    {
        try {
            $message = "Incident Log updated successfully.";
            $serverProgramLogs     = ServerProgramLog::find($request->log_id);

            if ($request->resolve == "yes") {
                $incident_status = false;
                $serverProgramLogs->actual_up_time = $request->actual_up_time; 
            }else{
                $incident_status = true;    
                $serverProgramLogs->expected_up_time = $request->expected_up_time; 
            }

            $serverProgramLogs->impact              = $request->impact;
            $serverProgramLogs->remarks             = $request->remarks;
            $serverProgramLogs->created_by          = 1;
            $serverProgramLogs->updated_by          = 1;
            $serverProgramLogs->incident_status     = $incident_status;
            $serverProgramLogs->save();

            $response = array('message' => $message, 'alert-type' => 'success');
            return back()->with($response);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response)->withInput();
        }
    }


    /**
     * Get All Application Log List on blade
     * 
     */
    public function ProgramIncidents(Request $request)
    {
        try {
            $data = [];
            $servers = Server::get();
            $program_list = Application::get();

            $data['txt'] = 'Add';
            $data['btn'] = 'Save';
            $data['servers'] = $servers;
            $data['program_list'] = $program_list;
            $programs = ServerProgramLog::orderBy('_id', 'desc')->paginate(20);
            $data['programs'] = $programs;
            return view('server.program_incidents', $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }

    /**
     * Get All Application Log List on blade
     */
    public function getIncidentsByServer(Request $request)
    {
        try {
            $data = [];
            $servers = Server::get();
            $program_list = Application::get();

            $data['txt'] = 'Add';
            $data['btn'] = 'Save';
            $data['servers'] = $servers;
            $data['program_list'] = $program_list;

            $programs = ServerProgramLog::orderBy('_id', 'desc')->paginate(50);
            $data['programs'] = $programs;
            return view('server.program_incidents', $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }

   
    /**
     * 
     * return : blade view
     */
    public function externalIncidentList(Request $request, $timezone = "CDT")
    {
        try {
            $data = [];
              switch($timezone) 
               {
                    case($timezone == 'IST'):
                        $time = 'Asia/Kolkata';
                    break;

                    case($timezone == 'CDT'):
                        $time = 'America/New_York';
                    break;

                    case($timezone == 'CEST'):
                        $time = 'Europe/Amsterdam';
                    break;

                    default:
                    $time = 'America/New_York';
                }

            $application_list = Application::with(['logs.getServers', 'logs' => function ($query) {
                $query->where('incident_status', true);
            }])
                ->where('type', 'Application')
                ->orderBy('name', 'asc')
                ->get();

            $service_list = Application::with(['logs' => function ($query) {
                $query->where('incident_status', true);
            }])
                ->where('type', 'Service')
                ->orderBy('name', 'asc')
                ->get();

            $data['application_list'] = $application_list;
            $data['service_list'] = $service_list;
            $data['timezone'] = $timezone;

            return view('server.program_incident_logs', $data);
        } catch (\Exception $e) {
            Log::error($e->getMessage() . " Line:" . $e->getLine() . " " . $e->getFile());
            $response = array('message' => 'There is something wrong', 'alert-type' => 'error');
            return back()->with($response);
        }
    }


    /**
     * Server Application List Get
     */
    public function serverApplicationList(Request $request)
    {
        $data = [];
        $assigns = ServerApplicationAssigns::with('getApplications', 'getServers')->get();
        $data['assigns'] = $assigns;
        return view('server.server_application_assgin_list', $data);
    }









}//main function end   
