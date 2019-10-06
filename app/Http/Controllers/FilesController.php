<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JWTAuth;

class FilesController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');
        $path = $file->getRealPath();
        $file_data = array_map('str_getcsv', file($path));

        $header = $file_data[0][0];
        $columns = explode(';', $header);

        $file->move('leads.csv');

        return response()->json([
            'fields' => $columns,
        ]);
    }
}
