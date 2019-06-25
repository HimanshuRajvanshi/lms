<?php
//Server
Route::Get('server/list','ServerController@serverList')->name('server_list');

//Save Program 
Route::Post('program/','ApplicationController@saveProgram')->name('save_program');
//Display all Program 
Route::Get('program/list','ApplicationController@ProgramList')->name('program_list');
//get Assigned Server by program_id
Route::Get('assigned/program/server/{program_id}','ApplicationController@getServerByProgramId');
//Display all Incidents 
Route::Get('program/incidents','ServerController@ProgramIncidents')->name('program_incidents');
//Display all Incidents for External Users 
Route::Get('ext/program/incidents/{timezone?}','ServerController@externalIncidentList');


//Display all incidents by server
Route::Get('{server_name}/{server_id}/incidents','ServerController@getIncidentsByServer');
Route::Get('server/program/log','ServerController@serverProgramLog')->name('server_program_log');

Route::Post('post/server/log','ServerController@postServerProgramLog')->name('post_server_program_log');
Route::Post('edit/server/log','ServerController@editServerProgramLog')->name('edit_server_program_log');
Route::Get('log_detail/{id}','ServerController@getLogDetail')->name('get_log_detail');
Route::Get('server/application/list','ServerController@serverApplicationList')->name('server_application_list');

Route::Get('program/server_list/{program_id}','ApplicationController@getServerListByProgramId')->name('program_server_list');
//Assign Server to Application
Route::Post('assign/server/program/','ApplicationController@assignServerProgram')->name('assign_server_program');

// Currently not use
// Route::Get('server/program/log/list','ServerController@serverProgramLogList')->name('server_program_log_list');
