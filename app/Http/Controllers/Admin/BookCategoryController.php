<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\BookCategory;
class BookCategoryController extends Controller
{
    public function index(){
        $categories=BookCategory::all();
        return view('books.category', compact('categories'));
    }
    public function create(Request $request){
        $data=$request->all();
        BookCategory::create($data);
        ALert::success('Thành công', 'Tạo Danh Mục Thành Công');
        return redirect()->back();
    }
    public function edit(Request $request, $id){
        $category=BookCategory::find($id);
        $data=$request->all();
        $category->update($data);
        ALert::success('Thành công', 'Chỉnh Sửa Danh Mục Thành Công');
        return redirect()->back();
    }
    public function delete(Request $request, $id){
        BookCategory::find($id)->delete();
        ALert::success('Thành công', 'Xóa Danh Mục Thành Công');
        return redirect()->back();
      }
      public function deleteAll(Request $request){
        $data=$request->all();
        BookCategory::whereIn('id', explode(",",$data['ids']))->delete();
        return response()->json(['status' => true]);
      }
}
