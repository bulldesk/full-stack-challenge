<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Jobs\ProcessLeads;

class LeadsController extends Controller
{
    public function process(Request $request)
    {
        $mapped_fields = $request->all();
        
        $file = Storage::get('leads.csv');

        dd($file);


        // ProcessLeads::dispatch($file);
    }
}
