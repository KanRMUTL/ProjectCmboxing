<?php

namespace App\Http\Controllers\shopping;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    
    public function index()
    {
        return view('shopping.addmin.course.index');
    }

    public function courses()
    {
        return view('shopping.courses');
    }

    public function show($id)
    {
        return view('shopping.user.course');
    }

}
