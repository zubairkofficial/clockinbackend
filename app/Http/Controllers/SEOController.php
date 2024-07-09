<?php

namespace App\Http\Controllers;

use App\Models\SEO;
use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function store(Request $request)
    {
        $data = new SEO();
        $data->title = $request->title;
        $data->description = $request->description;
        $data->keywords = $request->keywords;
        $data->canonical = $request->canonical;
        $data->og = $request->og;
        $data->page_name = $request->page_name;
        $data->schema_markup = $request->schema_markup;
        $data->save();

        return response()->json(['data' => $data], 200);
    }

    public function update($id, Request $request)
    {
        $data = SEO::findOrFail($id);
        $data->title = $request->title;
        $data->description = $request->description;
        $data->keywords = $request->keywords;
        $data->canonical = $request->canonical;
        $data->page_name = $request->page_name;
        $data->og = $request->og;
        $data->save();
        return response()->json(['message' => 'SEO updated successfully'], 200);
    }

    // SEOController.php
    public function show(Request $request)
    {
        $pageName = $request->query('name');
        $data = SEO::where('page_name', $pageName)->first();
        return response()->json(['data' => $data]);
    }
    // SEOController.php
    public function showadmin()
    {
        $data = SEO::all();
        return response()->json(['data' => $data]);
    }

    public function destroy($id)
    {
        $data = SEO::findOrFail($id);
        $data->delete();
        return response()->json(['message', 'Deleted Successfully']);
    }
}
