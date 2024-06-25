<?php

namespace App\Http\Controllers;

use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'heading'=>'required',
            'subheading' => 'required',
            'version' => 'required',
        ]);
        $versions = $request->version;
        foreach($versions as $index => $version){
            if($request->hasFile("version.$index.file")){
                $file = $request->file("version.$index.file");
                $get_original_name = $file->getClientOriginalName();
                $filepath = $file->storeAs('files',$get_original_name,'public');
                $versions[$index]['file'] = $filepath;
            }
        }
        $data = new Download();
        $data->heading = $request->heading;
        $data->subheading = $request->subheading; 
        $data->version =json_encode($versions);
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
    public function update($id, Request $request) {
        $data = Download::findOrFail($id);
        
        $request->validate([
            'heading' => 'required',
            'subheading' => 'required',
            'version' => 'required',
        ]);
        
        $versions = $request->version;
        foreach ($versions as $index => $version) {
            if ($request->hasFile("version.$index.file")) {
                $file = $request->file("version.$index.file");
                $get_original_name = $file->getClientOriginalName();
                $filepath = $file->storeAs('files', $get_original_name, 'public');
                $versions[$index]['file'] = $filepath;
            }
        }
        
        $data->heading = $request->heading;
        $data->subheading = $request->subheading;
        $data->version = json_encode($versions);
        $data->save();
        
        return response()->json(['message' => 'Updated Successfully']);
    }
    
    public function download(Request $request){
        $filepath= $request->query('path');
        if(Storage::exists($filepath)){
            return Storage::download($filepath);
        }else{
            return response()->json(['error'=>'File not found'],404);
        }
    }
}
