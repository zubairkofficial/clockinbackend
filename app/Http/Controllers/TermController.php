<?php

namespace App\Http\Controllers;

use App\Models\Term;
use Illuminate\Http\Request;

class TermController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $data = new Term();
        $data->content = $request->content;
        $data->save();
    
        return response()->json(['message' => 'Term created successfully'], 200);
    }
    
    public function update($id, Request $request)
    {
        $request->validate([
            'content' => 'required',
        ]);
    
        $data = Term::findOrFail($id);
        $data->content = $request->content;
        $data->save();
    
        return response()->json(['message' => 'Term updated successfully'], 200);
    }
    
    public function show()
    {
        $data = Term::all();
        return response()->json(['data' => $data]);
    }
    public function destroy($id){
        $data = Term::findOrFail($id);
        $data->delete();
        return response()->json(['message','Deleted Successfully']);
    }
}
