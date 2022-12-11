<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\ClientInterest;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes ;

    /**
     * The attributes that are mass assignable. 
     *
     * @var array
     */
    protected $fillable = [
        'email', 
        'password', 
        'first_name', 
        'last_name',
        'contact_number',
        'birthday',
        'role_id',
        'created_by',
        'updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [    
        'email_verified_at' => 'datetime',
    ];

    public function clientInterests(){
        return $this->belongsToMany(Interest::class,'user_id','id')->withPivot(['client_interest'])->withTimestamps();
    }

    public function clients(){
        return $this->hasMany(self::class,'created_by','id');
    }
    
}
