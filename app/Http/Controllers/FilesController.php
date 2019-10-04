<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FilesController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = $file->getRealPath();

        Storage::put('leads.csv', file_get_contents($path));

        $file_data = array_map('str_getcsv', file($path));

        $header = $file_data[0][0];
        $columns = explode(';', $header);

        return response()->json([
            'fields' => $columns,
        ]);
    }
}
