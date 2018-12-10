<?php

namespace App\marketing;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = [
        'total',
        'sale_id'
    ];

    public function sale()
    {
        return $this->belongsTo('App\marketing\Sale');
    }
}
