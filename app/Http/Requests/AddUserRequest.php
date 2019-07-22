<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule, Session;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\JsonResponse;


class AddUserRequest extends FormRequest
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
            'department_Id'        =>'required',
            'user_code'            =>'required',
            'date_of_join'         =>'required',
            'first_name'           =>'required|min:3',
            'last_name'            =>'required', 
         // 'email'                =>'required|email|unique:users,email',
            'password'             =>'required|min:6', 
            'gender'               =>'required', 
            'date_of_birth'        =>'required', 
            'contact_number'       =>'required|numeric', 
            'emergency_number'     =>'required|numeric', 
            'designation'          =>'required', 
            'present_address'      =>'required', 
         // 'permanent_address'    =>'required', 
            'user_status'          =>'required',
            'status'               =>'required',  
            'image'                =>'nullable|mimes:jpeg,bmp,png,jpg|max:200000',
            'role_id'              =>'required',   
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
            'user.required'                 =>'Please enter employee code',
            'date_of_join.required'         =>'Please select date of join',
            'first_name.required'           =>'Please enter first name',
            'last_name.required'            =>'Please enter Last name', 
            'email.required'                =>'Please enter email', 
            'email.email'                   =>'Please enter a valid email',
            'password.required'             =>'Please enter password', 
            'gender.required'               =>'Please select gender', 
            'date_of_birth.required'        =>'Please select date of birth', 
            'contact_number.required'       =>'Please enter contact number', 
            'emergency_number.required'     =>'Please enter emergency number', 
            'designation.required'          =>'Please enter employee designation', 
            'present_address.required'      =>'Please enter present address', 
         // 'permanent_address.required'    =>'Please enter permanent address', 
            'user_status.required'          =>'please select employment status',
            'image.required'                =>'please select valid image',    
            'status.required'               =>'please select employee status',
            'role_id.required'              =>'please select role',
        ];
    }


}
