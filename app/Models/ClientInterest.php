<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class ClientInterest extends Model
{
    protected $fillable = ['user_id','interest_id'];
    public function clientInterest(){
        return $this->belongsTo(User::class,'id','user_id');
    }
}
