<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'description' => 'required'
        ]);
        $file = $request->file('image');
        $originalFileName = $file->getClientOriginalName();
        $imagePath = $file->storeAs('faqs',$originalFileName,'public');
        $feature = new FAQ();
        $feature->title = $request->title;
        $feature->description = $request->description;
        $feature->image = $imagePath;
        $feature->save();
        return response()->json(['success','Added Successfully']);
    }
    public function show(){
        $data = FAQ::all();
        return response()->json(['data'=>$data]);
    }
    public function destroy($id){
        $data = FAQ::findOrFail($id);
        $data->delete();
        return response()->json(['success','Delete Successfuly']);
    }
    public function update(Request $request , $id){
        $data = FAQ::findOrFail($id);
        $data->update($request->except('image'));
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('faqs', $imageName, 'public');
            $data->image = $imagePath;
            $data->save();
        }
        return response()->json(['success','updated successfully']);
    }
}
