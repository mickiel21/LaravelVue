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
        return false;
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
                'password' => 'min:6|required_with:confirm_password|same:confirm_password',
                'confirm_password' => 'min:6',
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric|digits_between:7,11',
                'birthday'  => 'required|date',
                'role_id' => 'required|sometimes'
            ];
        }else {
            return [
                'email' => 'required|email|unique:users,email,' . $request->id,
                'first_name' => 'required',
                'last_name' => 'required',
                'contact_number' => 'required|numeric|digits_between:7,11',
                'birthday'  => 'required|date',
                'role_id' => 'required'
            ];
        }
    }

}