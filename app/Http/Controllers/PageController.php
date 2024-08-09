<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string|unique:pages',
            'rows' => 'required|array',
            'rows.*.columns' => 'required|array',
            'rows.*.columns.*.content' => 'nullable',
            'rows.*.columns.*.type' => 'nullable',
            'rows.*.columns.*.style' => 'nullable|array',
        ]);

        \Log::info('Validated Data:', $validatedData);

        $page = Page::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
        ]);

        foreach ($validatedData['rows'] as $rowIndex => $rowData) {
            $row = $page->rows()->create([
                'page_id' => $page->id,
            ]);

            foreach ($rowData['columns'] as $columnIndex => $columnData) {
                \Log::info('Column Data:', $columnData);

                $content = $columnData['content'];
                $type = $columnData['type'];

                $fileKey = "rows.$rowIndex.columns.$columnIndex.content";
                if ($request->hasFile($fileKey)) {
                    $file = $request->file($fileKey);
                    $filePath = $file->store('newpage', 'public');
                    $content = $filePath;
                }

                $row->columns()->create([
                    'row_id' => $row->id,
                    'data' => json_encode([
                        'content' => $content,
                        'type' => $type,
                        'style' => $columnData['style'] ?? [],
                    ]),
                ]);
            }
        }

        $page->load('rows.columns');

        return response()->json(['success' => true, 'page' => $page], 201);
    }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'name' => 'required|string',
    //         'slug' => 'required|string|unique:pages',
    //         'rows' => 'required|array',
    //         'rows.*.columns' => 'required|array',
    //         'rows.*.columns.*.content' => 'nullable|string',
    //         'rows.*.columns.*.style' => 'nullable|array',
    //     ]);

    //     \Log::info('Validated Data:', $validatedData);

    //     $page = Page::create([
    //         'name' => $validatedData['name'],
    //         'slug' => $validatedData['slug'],
    //     ]);

    //     foreach ($validatedData['rows'] as $rowData) {
    //         $row = $page->rows()->create([
    //             'page_id' => $page->id,
    //         ]);

    //         foreach ($rowData['columns'] as $columnData) {
    //             \Log::info('Column Data:', $columnData);

    //             $row->columns()->create([
    //                 'row_id' => $row->id,
    //                 'data' => json_encode([
    //                     'content' => $columnData['content'],
    //                     'style' => $columnData['style'] ?? [],
    //                 ]),
    //             ]);
    //         }
    //     }

    //     $page->load('rows.columns');

    //     return response()->json(['success' => true, 'page' => $page], 201);
    // }
    public function show($page_id)
    {
        $page = Page::with(['rows.columns'])->findOrFail($page_id);

        return response()->json($page, 200);
    }

}
