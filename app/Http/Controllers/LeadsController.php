<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessLeads;
use App\Lead;
use JWTAuth;

class LeadsController extends Controller
{
    public function process(Request $request)
    {
        $mapped_fields = $request->get('fields');
        
        $path = Storage::disk('local')->path('leads.csv');
        $file_data = array_map('str_getcsv', file($path));
        
        $headers = explode(';', $file_data[0][0]);
        unset($file_data[0]);
        $file_data = array_values($file_data);

        foreach ($file_data as $row) {
            $row_values = explode(';', $row[0]);
            $register = [];

            for ($i = 0; $i < count($headers); $i++) {
                if (array_key_exists($i, $row_values)) {
                    $register[$headers[$i]] = $row_values[$i];
                }
            }

            ProcessLeads::dispatch([
                'fields' => $mapped_fields,
                'lead' => $register,
                'total' => count($file_data),
            ]);
        }

        return response()->json([
            'status' => true,
        ]);
    }
}
