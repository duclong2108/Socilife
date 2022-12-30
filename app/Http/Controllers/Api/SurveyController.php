<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\SurveyUser;
use Illuminate\Support\Facades\Auth;
class SurveyController extends Controller
{
    public function index(){
        $surveys=Survey::all();
        return response()->json(['statusCode'=>200, 'data'=>['surveys'=>$surveys]]);
    }
    public function questions(Request $request){
        $data=$request->all();
        $questions=Question::where('survey_id', $data['survey_id'])->get();
        foreach($questions as $question){
            $question['answer']=explode(",",$data['answer']);
        }
        return response()->json(['statusCode'=>200, 'data'=>['questions'=>$questions]]);
    }
    public function sendSurvey(Request $request){
        $data=$request->all();
        $data['user_id']=Auth::user()->id;
        SurveyUser::create($data);
        return response()->json(['statusCode'=>200, 'message'=>'Gửi khảo sát thành công']);
    }
}
