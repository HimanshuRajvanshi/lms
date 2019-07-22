<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule, Session;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\JsonResponse;


class LogProgramIncidentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'program_id'        =>'required',
            'server_id'         =>'required',
            'impact'            =>'required',
            'reason'            =>'required',
            'app_down_time'     =>'required',
            'expected_up_time'  =>'required',
            'remarks'           =>'required',
        ];
    }


    /**
     * Get the validation message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'program_id.required'           =>'Please select program',
            'server_id.required'            =>'Please select serve',
            'impact.required'               =>'Please select impact',
            'app_down_time.required'        =>'Please select program down at',
            'expected_up_time.required'     =>'Please select expected up time',
            'remarks.required'              =>'Please enter remarks',
        ];
    }


}
