<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $table = 'trainers';
    protected $fillable = ['name', 'detail', 'img'];
    public $timestamps = false;

    public function courseRegister()
    {
        return $this->hasMany('App\shopping\CourseRegister');
    }
}
