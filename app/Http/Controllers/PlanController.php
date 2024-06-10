<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'employee' => 'required|string',
            'tasks' => 'required|string',
            'plan_feature' => 'required|json',
            'plan_type' => 'required',
            'offline_mode' => 'nullable',
        ]);

        $plan = new Plan();
        $plan->name = $request->name;
        $plan->price = $request->price;
        $plan->employee = $request->employee;
        $plan->tasks = $request->tasks;
        $plan->plan_feature = $request->plan_feature;
        $plan->plan_type = $request->plan_type;
        $plan->offline_mode = $request->offline_mode;
        $plan->save();

        return response()->json(['success' => 'Plan added successfully']);
    }
    public function show(){
        $data = Plan::all();
        return response()->json(['data' => $data]);
    }
    public function destroy($id){
        $data = Plan::findOrFail($id);
        $data->delete();
        return response()->json(['message','Deleted Successfully']);
    }
    public function update($id , Request $request){
        $data = Plan::findOrFail($id);
        $data->update([
            'name' => $request->name,
            'price' => $request->price,
            'employee' => $request->employee,
            'tasks' => $request->tasks,
            'plan_type' => $request->plan_type,
            'plan_feature' => $request->plan_feature,
            'offline_mode' => $request->offline_mode,
        ]);
        return response()->json(["message",'Updated Succesfully']);
    }
}
