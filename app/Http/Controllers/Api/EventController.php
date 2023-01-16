<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(){
        $events=Event::paginate(20);
        foreach($events as $event){
            $event['description']=html_entity_decode($event['description']);
        }
        return response()->json(['statusCode'=>200, 'data'=>['events'=>$events]]);
    }
    public function detail(Request $request){
        $data=$request->all();
        $event=Event::find($data['id']);
        $event['description']=html_entity_decode($event['description']);
        return response()->json(['statusCode'=>200, 'data'=>['event'=>$event]]);
    }
}
