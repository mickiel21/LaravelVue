<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class RegisterController extends Controller
{
    protected function create(Request $request){

        $request->validate([
            'email' => 'required',
            'password' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_no' => 'required',
            'birthday' => 'required',
          
        ]);
        
            $data = $request->all();

            User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact_no', $request->contact_no,
                'birthday' => $request->birthday,
                'role_id' => 1,
            ]);
        
        // auth()->login($user);
        
        return redirect()->to('/games');
    }
}

