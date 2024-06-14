<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'heading'=>'required',
            'subheading' => 'required',
            'version' => 'required',
        ]);
        $data = new Download();
        $data->heading = $request->heading;
        $data->subheading = $request->subheading;
        $data->version = $request->version;
        $data->save();
        return response()->json(['message','Added Successfuly']);
    }
    public function show(){
        $data = Download::all();
        return response()->json(['data'=>$data]);
    }
    public function destroy($id){
        $data = Download::findOrFail($id);
        $data->delete();
        return response()->json(['message','Deleted Successfully']);
    }
    public function update($id,Request $request){
        $data = Download::findOrFail($id);
        $data->update($request->all());
        return response()->json(['message'=> 'Updated Successfuly']);
    }
}
