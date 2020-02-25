<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class Fight extends Model
{
    protected $table = 'fights';
    protected $fillable = ['img','day','created_at'];
    public $timestamps = false;
}
