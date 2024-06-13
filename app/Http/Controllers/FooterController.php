<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Footer;
class FooterController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'menu'=>'required',
            'submenu' => 'required',
        ]);
        $data = new Footer;
        $data->menu = $request->menu;
        $data->submenu = $request->submenu;
        $data->save();
        return response()->json(['message','Added Successfuly']);
    }
    public function show(){
        $data = Footer::all();
        return response()->json(['data'=>$data]);
    }
    public function destroy($id){
        $data = Footer::findOrFail($id);
        $data->delete();
        return response()->json(['message','Deleted Successfully']);
    }
    public function update($id,Request $request){
        $data = Footer::findOrFail($id);
        $data->update($request->all());
        return response()->json(['message'=> 'Updated Successfuly']);
    }
}
