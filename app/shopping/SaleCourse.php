<?php

namespace App\shopping;

use Illuminate\Database\Eloquent\Model;

class SaleCourse extends Model
{
    protected $table ='sale_courses';
    protected $fillable =['created_at', 'updated_at', 'user_id', 'course_id'];
}
