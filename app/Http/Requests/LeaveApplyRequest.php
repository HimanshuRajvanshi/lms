<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule, Session;
//use Response

class LeaveApplyRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'leave_Id'      => 'required',
            'leave_reason'  => 'required',
            'leavedate'     => 'required',
            'phone'         => 'required',
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
            'leave_Id.required'            =>'Please select leave type',
            'leave_reason.required'        =>'Please enter leave reason',
            'leavedate.required'           =>'Please select date for leave',
            'phone.required'               =>'Please enter mobile number',
        ];
    }



    
}
