<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
class UserRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if(\Request::getMethod() == "POST"){
            return [
                'email' => 'required|email|unique:users',  
                'password'=> ['required', 
                                'min:6', 
                                'regex:/[a-z]/',      // must contain at least one lowercase letter
                                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                                'confirmed'
                            ],
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric|digits_between:7,11',
                'birthday'  => 'required|date',
                'role_id' => 'required'
            ];
        }else {
            return [
                'email' => 'required|email|unique:users',  
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric|digits_between:7,11',
                'birthday'  => 'required|date',
                'role_id' => 'required'
            ];
        }
    }

}