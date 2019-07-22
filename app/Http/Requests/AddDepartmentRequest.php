<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule, Session;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\JsonResponse;


class AddDepartmentRequest extends FormRequest
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
            'comany_id'          =>'required',
            'department_name'    =>'required',
            'location'           =>'required',
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
            'comany_id.required'           =>'Please select company name',
            'department_name.required'     =>'Please enter department',
            'location.required'            =>'Please enter location',
        ];
    }


}
