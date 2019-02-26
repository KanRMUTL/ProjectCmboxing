<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employees';
    protected $fillable = [
        'user_id',
        'id_card',
        'zone_id',
    ];
    public $timestamps = false;
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function zone()
    {
        return $this->belongsTo('App\marketing\Zone');
    }
}
