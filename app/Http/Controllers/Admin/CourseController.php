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
      // dd($data);
      if(isset($data['video'])){
        $data['video'] = implode(",",$data['video']);
      }
      $data['admin_id']=Auth::guard('admin')->user()->id;
      if(isset($data['image'])){
        Course::create($data);
        return redirect('/admin/courses')->with('message_success', 'Course Created Successfully.');
      }else{
        return redirect()->back()->with('message_error', 'Image not selected.');
      }
      
    }
    return view('courses.create');
  }
  public function edit(Request $request, $id){
    $course=Course::find($id);
    
    if($request->isMethod('POST')){
      $data=$request->all();
      if(isset($data['video'])){
        $data['video'] = implode(",",$data['video']);
      }
      if(isset($data['image'])){
        $course->update($data);
        return redirect('/admin/courses')->with('message_success', 'Course Updated Successfully.');
      }else{
        return redirect()->back()->with('message_error', 'Image not selected.');
      }
      
    }
    return view('courses.edit', compact('course'));
  }
  public function delete(Request $request, $id){
    Course::find($id)->delete();
    return redirect()->back()->with('message_success', 'Course Deleted Successfully.');
  }
  public function deleteAll(Request $request){
    $data=$request->all();
    Course::whereIn('id', explode(",",$data['ids']))->delete();
    return response()->json(['status' => true]);
  }
}
