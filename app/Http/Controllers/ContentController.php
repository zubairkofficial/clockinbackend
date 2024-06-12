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
            ['section' => $section],
            ['content' => $content],
        );
        return response()->json(['data', $data]);
    }
    public function show($section)
    {
        $data = Content::where('section', $section)->first();

        return response()->json(['data' => $data]);
    }

}
