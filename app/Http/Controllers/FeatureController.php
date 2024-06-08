<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function add(Request $request){
        $request->validate([
            'image' => 'required',
            'heading' => 'required',
            'paragraph' => 'required'
        ]);
        $file = $request->file('image');
        $originalFileName = $file->getClientOriginalName();
        $imagePath = $file->storeAs('features',$originalFileName,'public');
        $feature = new Feature;
        $feature->heading = $request->heading;
        $feature->paragraph = $request->paragraph;
        $feature->image = $imagePath;
        $feature->save();
        return response()->json(['success','Added Successfully']);
    }
    public function show(){
        $data = Feature::all();
        return response()->json(['data'=>$data]);
    }
    public function delete($id){
        $data = Feature::findOrFail($id);
        $data->delete();
        return response()->json(['success','Delete Successfuly']);
    }
    public function update(Request $request , $id){
        $data = Feature::findOrFail($id);
        $data->update($request->except('image'));
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('features', $imageName, 'public');
            $data->image = $imagePath;
            $data->save();
        }
        return response()->json(['success','updated successfully']);
    }
}
