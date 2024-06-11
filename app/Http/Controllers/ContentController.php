<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function store(Request $request)
    {
        $section = $request->input('section');
        $content = $request->input('content');
        $data = Content::updateOrCreate(
            ['section' =>$section],
            ['content'=>  $content],
        );
        return response()->json(['data', $data]);
    }
    public function show($section)
{
    \Log::info('Fetching content for section: ' . $section); // Log the section being queried

    $data = Content::where('section', $section)->first();

    if (!$data) {
        \Log::warning('No content found for section: ' . $section); // Log a warning if no data is found
        return response()->json(['message' => 'No content found'], 404);
    }
    \Log::info($data);
    return response()->json(['data' => $data]);
}

}
