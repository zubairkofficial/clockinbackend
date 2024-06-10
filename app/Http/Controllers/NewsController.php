<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'image' => 'required',
            'title' => 'required',
            'description' => 'required',
            'slug' => 'required'
        ]);
        $file = $request->file('image');
        $originalFileName = $file->getClientOriginalName();
        $imagePath = $file->storeAs('news',$originalFileName,'public');
        $feature = new News();
        $feature->title = $request->title;
        $feature->description = $request->description;
        $feature->slug = $request->slug;
        $feature->image = $imagePath;
        $feature->save();
        return response()->json(['success','Added Successfully']);
    }
    public function show(){
        $data = News::all();
        return response()->json(['data'=>$data]);
    }
    public function destroy($id){
        $data = News::findOrFail($id);
        $data->delete();
        return response()->json(['success','Delete Successfuly']);
    }
    public function update(Request $request , $id){
        $data = News::findOrFail($id);
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
    public function detail($slug) {
        $data = News::where('slug', $slug)->firstOrFail();
        return response()->json(['data' => $data]);
    }
    public function latest(){
        $data = News::latest()->take(3)->get();
        return response()->json(['data'=>$data]);
    }
}
