<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{
    public function index(Request $request)
  {
    $books = Book::all();
    return View('books.index', compact('books'));
  }
  public function create(Request $request)
  {
    if ($request->isMethod('POST')) {
      $data = $request->all();
      // dd($data);
      $data['admin_id']=Auth::guard('admin')->user()->id;
      if(isset($data['image'])){
        Book::create($data);
        ALert::success('Thành công', 'Tạo Thành Công Sách');
        return redirect('/admin/books');
      }else{
        ALert::error('Lỗi', 'Thiếu Ảnh');
        return redirect()->back();
      }
      
    }
    return view('books.create');
  }
  public function edit(Request $request, $id){
    $book=Book::find($id);
    
    if($request->isMethod('POST')){
      $data=$request->all();
      
      if(isset($data['image'])){
        $book->update($data);
        ALert::success('Thành công', 'Chỉnh Sửa Thành Công Sách');
        return redirect('/admin/books');
      }else{
        ALert::error('Lỗi', 'Thiếu Ảnh');
        return redirect()->back();
      }
      
    }
    return view('books.edit', compact('book'));
  }
  public function delete(Request $request, $id){
    Book::find($id)->delete();
    ALert::success('Thành công', 'Xóa Sách Thành Công');
    return redirect()->back();
  }
  public function deleteAll(Request $request){
    $data=$request->all();
    Book::whereIn('id', explode(",",$data['ids']))->delete();
    return response()->json(['status' => true]);
  }
  
}
