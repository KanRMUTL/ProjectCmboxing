<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_id',
        'firstname',
        'lastname',
        'username',
        'email',
        'phone_number',
        'address',
        'role',
        'password'
    ];
    public $timestamps = false;
    protected $hidden = [
        'password', 'remember_token',
    ];

    
    public function employee()
    {
        return $this->hasOne('App\marketing\Employee');
    }

   

    public function sales()
    {
        return $this->hasMany('App\marketing\Sale');
    }

    public function scopeUserForAdmin($query)
    {
        return $query
            ->where('role','NOT LIKE', 1)
            ->join('employees','users.id', '=', 'employees.user_id');
    }

    public function scopeUserForMkhead($query)
    {
        return $query
            ->where([
                ['zone_id','=',  Auth::user()->employee->zone_id],
                ['role','=', 3]
            ]);
    }
}
