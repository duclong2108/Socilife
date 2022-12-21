<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{

  public function index(Request $request)
  {
    $courses = Course::All();
    return View('courses.index', compact('courses'));
  }
}