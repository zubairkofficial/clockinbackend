<?php

namespace App\Http\Controllers;

use App\Models\Achievements;
use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function store(Request $request) {
        $request->validate([
            'brand_logo' => 'required|file|mimes:jpg,jpeg,png',
            'review' => 'required|string',
            'user_name' => 'required|string',
            'user_image' => 'required|file|mimes:jpg,jpeg,png'
        ]);
    
        if ($request->hasFile('brand_logo')) {
            $file1 = $request->file('brand_logo');
            $filename1 = time() . '_' . $file1->getClientOriginalName();
            $brandlogo = $file1->storeAs('achievements', $filename1, 'public');
        }
    
        if ($request->hasFile('user_image')) {
            $file2 = $request->file('user_image');
            $filename2 = time() . '_' . $file2->getClientOriginalName();
            $userimage = $file2->storeAs('achievements', $filename2, 'public');
        }
    
        $data = new Achievements();
        $data->brand_logo = $brandlogo ?? null;
        $data->user_image = $userimage ?? null;
        $data->review = $request->review;
        $data->user_name = $request->user_name;
        $data->save();
    
        return response()->json(['success' => 'Added Successfully']);
    }
    
    public function show(){
        $data = Achievements::all();
        return response()->json(['data' => $data]);
    }
    public function destroy($id){
        $data = Achievements::findOrFail($id);
        $data->delete();
        return response()->json(['success','Delete Successfuly']);
    }
    public function update($id , Request $request){
        $data = Achievements::findOrFail($id);
        $data->update($request->except('brand_logo','user_image'));
        if($request->hasFile('brand_logo')){
            $image = $request->file('brand_logo');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('features', $imageName, 'public');
            $data->brand_logo = $imagePath;
        }
        if($request->hasFile('user_image')){
            $image = $request->file('user_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('features', $imageName, 'public');
            $data->user_image = $imagePath;
        }
        $data->save();
        return response()->json(['success' => 'Updated successfully']);
    }
}
