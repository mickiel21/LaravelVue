<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\ClientInterest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\User\UserRequest;

class UserController extends Controller
{
  

    public function index() {

        $userClient = User::with(['clients'])->where('created_by',\Auth::user()->id,)->paginate(5);
        return resolveResponse(__('client.fetch_success'), $userClient);

        // $users = User::with(['clients','clientInterests'])->paginate(5);
        // return resolveResponse(__('client.fetch_success'), $users);
    }

    public function show($id) {
        try {
           $user = User::with('clientInterests')->findOrFail($id);
            return resolveResponse(__('client.fetch_success'),$user);
        }catch(\Exception $e) {
            return rejectResponse(__('client.fetch_failed'), null);
        }
    }

    public function store(UserRequest $request) {
        \DB::beginTransaction();
        try {
           $user = User::create([
                'email' => $request->email,
                'password' => $request->password ? bcrypt($request->password) : '',
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact_number' => $request->contact_number,
                'birthday' => $request->birthday,
                'role_id' => 2, 
                'created_by' => \Auth::user()->id,
            ]);

            foreach($request->interests as $interest){
                $user->clientInterests()->create([
                    'interest_id' => $interest,
                ]);
            }
           
          
            \DB::commit();
            return resolveResponse(__('client.create_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('client.create_failed'), $e);
        }
    }

    public function update(UserRequest $request, $id) {
        \DB::beginTransaction();
        try {
           $user = User::findOrFail($id);
           $user->update([
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'contact_number' => $request->contact_number,
                'birthday' => $request->birthday,
                'role_id' => 2, 
                'updated_by' => \Auth::user()->id
            ]);
            
            // foreach($request->interests as $interest){
            //     $user->clientInterests()->update([
            //         'interest_id' => $interest,
            //     ]);
            // }
            \DB::commit();
            return resolveResponse(__('client.update_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('client.update_failed'), null);
        }
    }

    public function delete($id) {
        \DB::beginTransaction();
        try {
           $user = User::findOrFail($id);
           $user->delete();
            \DB::commit();
            return resolveResponse(__('client.delete_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('client.delete_failed'), null);
        }
    }

    public function restore($id) {
        \DB::beginTransaction();
        try {
           $user = User::onlyTrashed()->findOrFail($id);
           $user->restore();
            \DB::commit();
            return resolveResponse(__('client.restore_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('client.restore_failed'), null);
        }
    }
}
