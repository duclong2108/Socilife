<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notify;
use App\Models\NotifyUser;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class NotifyController extends Controller
{
    public function pagination($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    public function index(Request $request){
        if(User::where('token', $request->bearerToken())->count()>0){
            $notifies=Notify::orderBy('id','desc')->get();
            $xxx=array();
            foreach($notifies as $notify){
                $notify['description']=html_entity_decode($notify['description']);
                if(count(NotifyUser::where('notify_id', $notify['id'])->where('user_id', User::where('token', $request->bearerToken())->first()->id)->get())>0){
                    $notify['check']=NotifyUser::where('notify_id', $notify['id'])->where('user_id', User::where('token', $request->bearerToken())->first()->id)->first()->check;
                    array_push($xxx, $notify);
                }
            }
            $data=$this->pagination($xxx);
            return response()->json(['statusCode'=>200, 'data'=>['notifies'=>$data]]);
        }else{
            return response()->json(['statusCode'=>401, 'message'=>'Unauthorized']);
        }
    }
    public function detail(Request $request){
        if(User::where('token', $request->bearerToken())->count()>0){
            $data=$request->all();
            $notify=Notify::find($data['id']);
            if($request->isMethod('post')){
                if(count(NotifyUser::where('notify_id', $notify['id'])->where('user_id', User::where('token', $request->bearerToken())->first()->id)->get())>0){
                    $notify_user_check=NotifyUser::where('notify_id', $notify['id'])->where('user_id', User::where('token', $request->bearerToken())->first()->id)->first();
                    $notify_user_check->update(['check'=>1]);
                    return response()->json(['statusCode'=>200, 'message'=>'Đã đọc']);
                }else{
                    return response()->json(['statusCode'=>404, 'message'=>'Người dùng không có thông báo này']);
                }
                
            }
            $notify['description']=html_entity_decode($notify['description']);
            $notify['check']=NotifyUser::where('notify_id', $notify['id'])->where('user_id', User::where('token', $request->bearerToken())->first()->id)->first()->check;
            return response()->json(['statusCode'=>200, 'data'=>['notify'=>$notify]]);
        }else{
            return response()->json(['statusCode'=>401, 'message'=>'Unauthorized']);
        }
    }
}
