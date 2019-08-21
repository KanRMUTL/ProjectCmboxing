<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;
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
        'img',
        'password'
    ];
    public $timestamps = false;
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $guarded = [];

    
    public function employee()
    {
        return $this->hasOne('App\marketing\Employee'); // hasOne อ่ะถูกแล้ว อย่าเปลี่ยนไม่งั้นเจ๊ง!!
    }

    public function sales()
    {
        return $this->hasMany('App\marketing\Sale', 'id', 'user_id');
    }

    public function courseRegister()
    {
        return $this->hasMany('App\shopping\CourseRegister');
    }

    public function saleTicket()
    {
        return $this->hasMany('App\shopping\SaleTicket', 'user_id', 'id');
    }

    public function scopeGetUsers($query)
    {
        if(Auth()->user()->role == 1)
        {   // Addmin
            return $query
            ->where([['role','NOT LIKE', 1], ['role','NOT LIKE', 4]]);
        }
        else
        {   // Marketing Head
            return $query
                ->select('users.id', 'firstname', 'lastname', 'username', 'email', 'phone_number', 'address', 'img', 'role')
                ->join('employees', 'users.id', '=', 'employees.user_id')
                ->where([
                    ['employees.zone_id','=',  Auth::user()->employee->zone_id],
                    ['role','=', 3]
                ]);
        }               
    }

    public function checkPass($password) 
    {
        return Hash::check($password, $this->password) ? true : false;
    }
}
