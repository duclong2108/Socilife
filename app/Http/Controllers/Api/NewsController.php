<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
class NewsController extends Controller
{
    public function index(){
        return response()->json(['statusCode'=>200, 'data'=>['news'=>News::all()]]);
    }
    public function detail(Request $request){
        $data=$request->all();
        $news=News::find($data['id']);
        return response()->json(['statusCode'=>200, 'data'=>['news'=>$news]]);
    }
}
