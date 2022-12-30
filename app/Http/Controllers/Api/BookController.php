<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BookUser;
class BookController extends Controller
{
    public function index(){
        $books=Book::with('bookChapter')->get();
        return response()->json(['statusCode'=>200, 'data'=>['books'=>$books]]);
    }
    public function buyBook(Request $request){
        $data=$request->all();
        if(Auth::check()){
            $data['user_id']=Auth::user()->id;
            BookUser::create($data);
            return response()->json(['statusCode'=>200, 'message'=>'Thêm giỏ hàng thành công']);
        }else{
            return response()->json(['statusCode'=>401, 'message'=>'Bạn cần đăng nhập tài khoản để thực hiện chức năng này']);
        }
    }
    public function detail(Request $request){
        $data=$request->all();
        $book=Book::with('bookChapter')->find($data['id']);
        return response()->json(['statusCode'=>200, 'data'=>['book'=>$book]]);
    }
}
