<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use Illuminate\Http\Request;

class NotifyController extends Controller
{
    public function index(){
        return response()->json(['statusCode'=>200, 'data'=>['notifies'=>Notify::orderBy('id','desc')->get()]]);
    }
}
