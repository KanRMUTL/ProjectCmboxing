<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Guesthouse extends Model
{
    protected $table = 'guesthouses';
    protected $fillable = [
        'name',
        'zone_id'
    ];
    public $timestamps = false;

    public function zone()
    {
        return $this->belongsTo('App\marketing\Zone');
    }

    public function sales()
    {
        return $this->hasMany('App\marketing\Sale');
    }

    public function scopeForsale($query){  // แสดงรายชื่อเกสเฮาท์ที่อยู่ในโซนเดียวกับผู้ใช้
        return $query
               ->where('zone_id','=', Auth::user()->employee->zone_id)
               ->orderBy('name');
    }
}
