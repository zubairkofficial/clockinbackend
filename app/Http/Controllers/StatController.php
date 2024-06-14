<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stat;
class StatController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'total_task' => 'required',
            'task_completed' => 'required',
            'remaining_task' => 'required',
            'heading' => 'required',
            'content' => 'required|json',
        ]);
    
        $data = new Stat();
        $data->total_task = $request->total_task;
        $data->task_completed = $request->task_completed;
        $data->remaining_task = $request->remaining_task;
        $data->heading = $request->heading;
        $data->content = $request->content;
        $data->save();
    
        return response()->json(['message' => 'Stat created successfully'], 200);
    }
    
    public function update($id, Request $request)
    {
        $request->validate([
            'total_task' => 'required',
            'task_completed' => 'required',
            'remaining_task' => 'required',
            'heading' => 'required',
            'content' => 'required|json',
        ]);
    
        $data = Stat::findOrFail($id);
        $data->total_task = $request->total_task;
        $data->task_completed = $request->task_completed;
        $data->remaining_task = $request->remaining_task;
        $data->heading = $request->heading;
        $data->content = $request->content;
        $data->save();
    
        return response()->json(['message' => 'Stat updated successfully'], 200);
    }
    
    public function show()
    {
        $data = Stat::all();
        return response()->json(['data' => $data]);
    }
    
}
