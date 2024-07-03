<?php

namespace App\Http\Controllers;
use App\Models\Privacy;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $data = new Privacy();
        $data->content = $request->content;
        $data->save();
    
        return response()->json(['message' => 'Privacy created successfully'], 200);
    }
    
    public function update($id, Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $data = Privacy::findOrFail($id);
        $data->content = $request->content;
        $data->save();
    
        return response()->json(['message' => 'Privacy updated successfully'], 200);
    }
    
    public function show()
    {
        $data = Privacy::all();
        return response()->json(['data' => $data]);
    }
    public function destroy($id){
        $data = Privacy::findOrFail($id);
        $data->delete();
        return response()->json(['message','Deleted Successfully']);
    }
}
