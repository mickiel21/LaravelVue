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
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'contact_number' => 'required',
            'birthday' => 'required',
          
        ]);
        \DB::beginTransaction();
        try {
            $user =  User::create([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact_number' => $request->contact_number,
                'birthday' => $request->birthday,
                'role_id' => 1,
            ]);

           
          
            \DB::commit();
            return resolveResponse(__('client.create_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('client.create_failed'), $e);
        }
    }
}

