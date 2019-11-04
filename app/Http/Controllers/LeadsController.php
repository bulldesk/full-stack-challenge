<?php

namespace App\Http\Controllers;

use App\Events\MessageNotification;
use App\Services\ImportLeadsService;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    /**
     * Método de importação do arquivo CSV
     *
     * @param Request $request
     */
    public function importFile(Request $request)
    {
        if ($request->has('file')) {

            $file           = $request->file('file');
            $fileExtension  = $file->getClientOriginalExtension();
            $fileName       = $file->getClientOriginalName();
            $validExtension = 'csv';
            $path           = 'uploads';

            $stored = ($fileExtension == $validExtension) ? $file->storeAs($path, $fileName) : null;

            !is_null($stored) ? new ImportLeadsService($file, $stored) : false;
        }

        broadcast(new MessageNotification());
    }
}
