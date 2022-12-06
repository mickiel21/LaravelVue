<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
  
    public function index() {
        $users = User::with([])->paginate(5);
        return resolveResponse(__('user.fetch_success'), $users);
    }

    public function show($id) {
        try {
           $user = User::findOrFail($id);
            return resolveResponse(__('user.fetch_success'),$user);
        }catch(\Exception $e) {
            return rejectResponse(__('user.fetch_failed'), null);
        }
    }

    public function store(Request $request) {
        \DB::beginTransaction();
        try {
           $user = User::create([
                
            ]);
            \DB::commit();
            return resolveResponse(__('user.create_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('user.create_failed'), null);
        }
    }

    public function update(Request $request, $id) {
        \DB::beginTransaction();
        try {
           $user = User::findOrFail($id);
           $user->update([
               
            ]);
            \DB::commit();
            return resolveResponse(__('user.update_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('user.update_failed'), null);
        }
    }

    public function delete($id) {
        \DB::beginTransaction();
        try {
           $user = User::findOrFail($id);
           $user->delete();
            \DB::commit();
            return resolveResponse(__('user.delete_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('user.delete_failed'), null);
        }
    }

    public function restore($id) {
        \DB::beginTransaction();
        try {
           $user = User::onlyTrashed()->findOrFail($id);
           $user->restore();
            \DB::commit();
            return resolveResponse(__('user.restore_success'),$user);
        }catch(\Exception $e) {
            \DB::rollback();
            return rejectResponse(__('user.restore_failed'), null);
        }
    }
}
