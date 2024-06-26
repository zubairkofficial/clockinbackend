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
        'image_path' => 'required|file',
        'mode' => 'required|string'
    ]);

    $section = $request->section;
    $mode = $request->mode;
    $imagePath = $request->file('image_path')->store('images', 'public');

    $existingImage = Image::where('section', $section)->where('mode', $mode)->first();

    if ($existingImage) {
        Storage::disk('public')->delete($existingImage->image_path);
        $existingImage->update([
            'image_path' => $imagePath,
        ]);
        return response()->json(['success' => 'Image updated successfully']);
    } else {
        Image::create([
            'section' => $section,
            'image_path' => $imagePath,
            'mode' => $mode,
        ]);
        return response()->json(['success' => 'Image uploaded successfully']);
    }
}

public function getimage(Request $request)
{
    $sections = $request->input('sections');
    $mode = $request->input('mode');
    $images = Image::whereIn('section', $sections)
                   ->where('mode', $mode)
                   ->get();

    $images->each(function ($image) {
        $image->image_url = Storage::url($image->image_path);
    });

    return response()->json(['images' => $images]);
}

}
