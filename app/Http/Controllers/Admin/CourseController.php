<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
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
        ALert::success('Thành công', 'Tạo Thành Công Khóa Học');
        return redirect('/admin/courses');
      }else{
        ALert::error('Lỗi', 'Thiếu Ảnh');
        return redirect()->back();
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
        ALert::success('Thành công', 'Chỉnh Sửa Thành Công Khóa Học');
        return redirect('/admin/courses');
      }else{
        ALert::error('Lỗi', 'Thiếu Ảnh');
        return redirect()->back();
      }
      
    }
    return view('courses.edit', compact('course'));
  }
  public function delete(Request $request, $id){
    Course::find($id)->delete();
    ALert::error('Thành công', 'Xóa Khóa Học Thành Công');
    return redirect()->back();
  }
  public function deleteAll(Request $request){
    $data=$request->all();
    Course::whereIn('id', explode(",",$data['ids']))->delete();
    return response()->json(['status' => true]);
  }
}
