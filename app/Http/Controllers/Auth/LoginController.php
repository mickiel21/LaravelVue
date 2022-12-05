<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;


class LoginController extends Controller
{
  
    public function login(LoginRequest $request) {
        $user = User::where('email', $request->user_name)->first();
        if($user){
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken('Laravel Vue API Token')->accessToken;
                    $response = [
                        'token' => $token,
                        'user' => $user,
                    ];
                    return resolveResponse(__('auth.login_success'), $response, 200);
                } else {
                    $response = "Email or Password mismatch";
                    return rejectResponse(__('auth.mismatch_password'), $response, 401);
                }
        }else{
            $response = "Email or Password mismatch";
            return rejectResponse(__('auth.mismatch_password'), $response, 401); 
        }
        
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
     
        $response = 'You have been succesfully logged out!';
        return response($response, 200);
     
     }
}
