<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'role_id',
        'zone_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function callUser(){
       
     }

     public function role()
     {
         return $this->belongsTo('App\marketing\Role');
     }

     public function zone()
     {
         return $this->belongsTo('App\marketing\Zone');
     }
     public function sales()
     {
         return $this->hasMany('App\marketing\Sale');
     }
}
