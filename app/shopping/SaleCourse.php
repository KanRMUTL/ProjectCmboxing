<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class SaleCourse extends Model
{
    protected $table ='sale_courses';
    protected $fillable =['created_at', 'user_id', 'course_id'];
    public $timestamps = false;

    public function courseRegister()
    {
        return $this->hasOne('App\Shopping\CourseRegister');
    }

    public function scopeDetail($query, $user_id) 
    {
        return $query
                ->select(
                    'courses.name as courseName',
                    'course_registers.start_course',
                    'trainers.name as trainerName',
                    'trainers.img as trainerImg',
                    'trainers.detail as trainerDetail',
                    'created_at'
                )
                ->join('course_registers', 'sale_courses.id', '=', 'course_registers.sale_course_id')
                ->join('trainers', 'course_registers.trainer_id', '=', 'trainers.id')
                ->join('courses', 'sale_courses.course_id', '=', 'courses.id');
    }
}

