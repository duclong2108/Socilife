<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class CourseController extends Controller
{

  public function index(Request $request)
  {
    $courses = Course::all();
    return View('courses.index', compact('courses'));
  }
  public function create(Request $request)
  {
    if ($request->isMethod('POST')) {
      $data = $request->all();
    }
    return view('courses.create');
  }
}
