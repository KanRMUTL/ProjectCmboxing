<?php

namespace App\Http\Controllers\Api\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\shopping\CourseRequest;
use App\shopping\Course;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return response()->json($courses);
    }
    
    public function store(CourseRequest $request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->price = $request->price;
        $course->detail = $request->detail;
        $course->save();
        return response()->json($course);
    }

    public function update(CourseRequest $request, $id)
    {
        $course = Course::find($id);
        $course->name = $request->name;
        $course->price = $request->price;
        $course->detail = $request->detail;
        $course->update();
        return response()->json($course);
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->delete();
        return response()->json(['message' => 'deleted']);
    }
}
