<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule, Session;
use Illuminate\Support\Facades\Input;
use Auth;
use Illuminate\Http\JsonResponse;


class AddProgramRequest extends FormRequest
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
            'type'            =>'required',
            'program_name'    =>'required',
            'description'     =>'required',
            'environment'     =>'required',
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
            'type.required'                 =>'Please select type',
            'program_name.required'         =>'Please enter program name',
            'description.required'          =>'Please enter description',
            'environment.required'          =>'please enter environment',    
        ];
    }


}
