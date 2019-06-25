<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home/dashboard', 'HomeController@index')->name('home');

//Company
Route::Get('/add/company', 'CompanyController@postCompany')->name('add_company');
Route::Post('/post/company','CompanyController@postSaveCompany')->name('post_company');
Route::Get('/add/company/{id}', 'CompanyController@postCompany')->name('edit_company');
Route::Get('/list/company','CompanyController@listsCompany')->name('lists_company');
Route::Get('/view/company/department/{id}','CompanyController@viewCompanyDepartment')->name('view_company_department');

//Department
Route::GET('/add/department','DepartmentController@addDepartment')->name('add_department');
Route::GET('/add/department/{id}','DepartmentController@addDepartment');
Route::Post('/post/department','DepartmentController@postDepartment')->name('post_Department');
Route::GET('/list/department','DepartmentController@listsDepartment')->name('lists_department');

//User
Route::GET('/add/user/page','UserController@addUserPage')->name('add_user_page');
Route::Post('/post/user','UserController@postUser')->name('post_user');
Route::GET('/list/user','UserController@listUser')->name('list_user');
Route::GET('user/profile/view/{user_Id}','UserController@userProfileView')->name('user_profile_view');

//Role
Route::GET('/add/role','RoleController@addRole')->name('add_role');

//Leave
Route::Get('add/leave','LeaveController@addLeave')->name('add_leave');
Route::Get('edit/leave/{id}','LeaveController@addLeave')->name('edit_leave');
Route::POST('/post/leave','LeaveController@postLeave')->name('post_leave');
Route::GET('list/apply/leave','LeaveController@listApplyLeave')->name('list_apply_leave');
Route::GET('leave/status/update/{Id}/{Type}','LeaveController@leaveStatusUpdate')->name('leave_status_update');
Route::Get('/add/leave/get/leave','LeaveController@getLeave');
Route::Get('/add/leave/delete/leave/{id}','LeaveController@deleteLeave');

//Attendance
Route::get('/upload_attendances', 'AttendanceController@index');    
Route::get('/upload/attendance/file', 'AttendanceController@uploadAttendance')->name('upload_attendance');
Route::POST('/upload/attendance/post_attendance', 'AttendanceController@postUploadAttendance')->name('post_upload_attendance');
Route::Get('/list/attendance','AttendanceController@listAttendance')->name('list_attendance');



//this is homepage time zone
Route::get('/{timezone?}', 'ServerController@externalIncidentList');


//for middelware admin
// Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
//     Route::get('/',function(){return "testing demo";});
// });

