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
    public function show()
    {
        $data = Content::all();

        return response()->json(['data' => $data]);
    }

}
