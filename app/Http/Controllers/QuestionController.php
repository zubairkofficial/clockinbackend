<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'subject' => 'required', 
            'email' => 'required', 
            'help' => 'required', 
        ]);
        $file = $request->file('image');
        $originalFileName = $file->getClientOriginalName();
        $imagePath = $file->storeAs('news',$originalFileName,'public');
        $data = new Question();
        $data->subject = $request->subject;
        $data->email = $request->email;
        $data->help = $request->help;
        $data->image = $imagePath;
        $data->save();
        return response()->json(['success' =>'Question submitted Successfully']);
    }
    public function show(){
        $data = Question::all();
        return response()->json(['data'=>$data]);
    }
}
