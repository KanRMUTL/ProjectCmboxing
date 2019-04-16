<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'id',
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

    public function courseRegister()
    {
        return $this->hasMany('App\shopping\CourseRegister');
    }

    public function scopeGetUsers($query)
    {
        if(Auth()->user()->role == 1)
        {   // Addmin
             
            return $query
            ->join('employees','users.id', '=', 'employees.user_id')
            ->where('role','NOT LIKE', 1);
        }
        else
        {   // Marketing Head
            return $query
                ->join('employees','users.id', '=', 'employees.user_id')
                ->where([
                    ['employees.zone_id','=',  Auth::user()->employee->zone_id],
                    ['role','=', 3]
                ]);
        }               
    }
}
