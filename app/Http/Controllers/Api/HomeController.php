<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Admin;
class HomeController extends Controller
{
    public function index(Request $request){
        $user=User::find(Auth::user()->id);
        $courses=Course::orderBy('sold', 'desc')->limit(6)->get();
        $xxx=array();
        foreach($courses as $course){
            array_push($xxx, ['name'=>Admin::find($course['admin_id'])->name, $course]);
            $xxx[]=$course;
        }
        return response()->json(['statusCode'=>200, 'data'=>['user'=>$user, 'courses'=>$xxx]]);
    }
}
