<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    public function store(Request $request){
        $request->validate([
            'section' => 'required|string',
            'image_path' => 'required',
            'mode' => 'required'
        ]);
        $existingImage = Image::where('section',$request->section)->where('mode',$request->mode)->first();
        $imagePath = $request->file('image_path')->store('images','public');
        if ($existingImage) {
            Storage::disk('public')->delete($existingImage->image_path);
            $existingImage->update([
                'image_path' => $imagePath,
            ]);
            return response()->json(['success' => 'Image updated successfully']);
        } else {
            Image::create([
                'section' => $request->section,
                'image_path' => $imagePath,
                'mode' => $request->mode,
            ]);
            return response()->json(['success' => 'Image uploaded successfully']);
        }
    }
    public function getimage($section,$mode){
        $image = Image::where('section', $section)->where('mode', $mode)->first();
        if ($image) {
            $image->image_url = Storage::url($image->image_path);
        }
        return response()->json($image);
    }
}
