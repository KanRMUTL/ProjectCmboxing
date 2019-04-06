<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class CourseRegister extends Model
{
    protected $table = 'course_registers';
    protected $fillable = ['start_course', 'sale_course_id', 'trainer_id'];
    public $timestamps = false;
}
