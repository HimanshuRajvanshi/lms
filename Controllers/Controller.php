<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;




use Illuminate\Http\Request;
// use Calendar;
use App\Models\Attendance;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    
}
