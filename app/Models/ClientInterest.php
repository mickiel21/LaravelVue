<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class ClientInterest extends Model
{
    public function clientInterest(){
        return $this->belongsTo(User::class,'id','user_id');
    }
}
