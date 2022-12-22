<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
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
      $data['admin_id']=Auth::guard('admin')->user()->id;
      Course::create($data);
      return redirect('/admin/courses')->with('message_success', 'Course Created Successfully.');
    }
    return view('courses.create');
  }
}
