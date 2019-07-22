<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule, Session;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\JsonResponse;


class AddCompanyRequest extends FormRequest
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
            'company_name'       =>'required',
            'gst_number'         =>'required',
            'address'            =>'required',
            'is_head_quarter'    =>'required',
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
            'company_name.required'       =>'Please enter company name',
            'gst_number.required'         =>'Please enter gst number',
            'address.required'            =>'Please enter address',
            'is_head_quarter.required'    =>'please select head quarter',    
        ];
    }


}
