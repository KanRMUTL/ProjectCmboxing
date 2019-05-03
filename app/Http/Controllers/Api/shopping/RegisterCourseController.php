<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\shopping\SaleCourse;
use App\shopping\CourseRegister;

class RegisterCourseController extends Controller
{
    public function store(Request $request)
    {
       $saleCourse = new SaleCourse();
       $courseRegister = new CourseRegister();
       
       $saleCourse->course_id = $request->courseId;
       $saleCourse->user_id = $request->userId;
       $saleCourse->save();

       $courseRegister->sale_course_id = $saleCourse->id;
       $courseRegister->start_course = $request->startCourse;
       $courseRegister->trainer_id = $request->trainerId;
       $courseRegister->save();

        return response()->json(['sale' => $saleCourse, 'register' => $courseRegister]);
    }

    public function show($user_id)
    {
        $saleCourse = SaleCourse::detail($user_id)->get();
        return response()->json($saleCourse);
    }
}
