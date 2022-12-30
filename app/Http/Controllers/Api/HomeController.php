<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
use App\Models\Book;
use App\Models\News;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Event;
use App\Models\Policy;
use App\Models\AboutUs;
class HomeController extends Controller
{
    public function index(Request $request){
        // dd($request->bearerToken());
        if(count(User::where('token', $request->bearerToken())->get())>0){
            $user=User::where('token', $request->bearerToken())->first();
        }else{
            $user="";
        }
        $courses=Course::orderBy('sold', 'desc')->limit(6)->get();
        $courses_new=array();
        foreach($courses as $course){
            array_push($courses_new, ['admin_name'=>Admin::find($course['admin_id'])->name, 'course_image'=>$course['image'], 'admin_image'=>Admin::find($course['admin_id'])->image,  'sold'=>$course['sold'], 'opening_date'=>date('d/m/Y', strtotime($course['opening_date'])), 'title'=>$course['title']]);
        }
        $books=Book::orderBy('sold', 'desc')->limit(6)->get();
        $books_new=array();
        foreach($books as $book){
            array_push($books_new, ['admin_name'=>Admin::find($book['admin_id'])->name, 'book_image'=>$book['image'], 'admin_image'=>Admin::find($book['admin_id'])->image,  'sold'=>$book['sold'], 'title'=>$book['title']]);
        }
        $news=News::orderBy('id', 'desc')->limit(3)->get();
        $event=Event::orderBy('id', 'desc')->limit(1)->first();
        return response()->json(['statusCode'=>200, 'data'=>['user'=>$user, 'banner'=>Banner::first(), 'courses'=>$courses_new, 'books'=>$books_new, 'news'=>$news, 'event'=>$event]]);
    }
    public function search(Request $request){
        $data=$request->all();
        $courses=Course::where('title', 'like', '%'. $data['query']. '%')->orWhere('admin_name', 'like', '%'. $data['query']. '%')->orWhere('sold', 'like', '%'. $data['query']. '%')->orWhere('opening_date', 'like', '%'. date('Y-m-d', strtotime($data['query'])). '%')->get()->toArray();
        $books=Book::where('title', 'like', '%'. $data['query'].'%')->orWhere('admin_name', 'like', '%'. $data['query']. '%')->orWhere('sold', 'like', '%'. $data['query']. '%')->get()->toArray();
        $news=News::where('title', 'like', '%'. $data['query']. '%')->orWhere('created_at', 'like', '%'. date('Y-m-d', strtotime($data['query'])). '%')->get()->toArray();
        return response()->json(['statusCode'=>200, 'data'=>['count'=>count($courses)+count($books)+count($news),'alls'=>array_merge($courses, $books, $news)]]);
    }
    public function filter(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $courses=Course::where('category_id', $data['category_id'])->get()->toArray();
            $books=Book::where('category_id', $data['category_id'])->get()->toArray();
            $news=News::where('category_id', $data['category_id'])->get()->toArray();
            return response()->json(['statusCode'=>200, 'data'=>['count'=>count($courses)+count($books)+count($news),'alls'=>array_merge($courses, $books, $news)]]);
        }
        return response()->json(['statusCode'=>200, 'data'=>['category'=>Category::all()]]);
    }
    public function policy(){
        return response()->json(['statusCode'=>200, 'data'=>['policy'=>Policy::first()]]);
    }
    public function aboutUs(){
        return response()->json(['statusCode'=>200, 'data'=>['about-us'=>AboutUs::first()]]);
    }
}
