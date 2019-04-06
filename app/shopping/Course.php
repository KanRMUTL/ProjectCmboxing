<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['name', 'price', 'detail'];
    public $timestamps = false;
}
