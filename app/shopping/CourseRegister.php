<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class CourseRegister extends Model
{
    protected $table = 'course_registers';
    protected $fillable = ['start_course', 'sale_course_id', 'trainer_id'];
    public $timestamps = false;

    public function saleCourse()
    {
        return $this->belongsTo('App\shopping\SaleCourse');
    }

    public function trainer()
    {
        return $this->belongsTo('App\shopping\Trainer');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeReport($query, $start, $end)
    {
        return  $query
                ->select(
                    'start_course', 
                    'sale_courses.created_at',
                    'trainer_id', 
                    'user_id', 
                    'courses.name as course_name',
                    'users.firstname as user_firstname',
                    'users.lastname as user_lastname',
                    'users.phone_number',
                    'trainers.name as trainer_name'
                )
                ->join('sale_courses', 'course_registers.sale_course_id', '=', 'sale_courses.id')
                ->join('trainers', 'course_registers.trainer_id', '=', 'trainers.id')
                ->join('users', 'sale_courses.user_id', '=', 'users.id')
                ->join('courses', 'sale_courses.course_id', '=', 'courses.id')
                ->whereBetween('start_course', [$start, $end]);
    }
}
