<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\csvData;
use App\Events\ImportDataEvent;

class FileController extends Controller
{
    public function receiveFile(Request $request) {
        $validated = $this->validateCSV();
        $name = $this->getFileName($validated); 
        $path = $this->getFilePath($validated);
        session(['filePath' => $path]);
        $headers = $this->readFileHeaders($path);
        $dbHeaders = $this->getDbHeaders();
        return view('showTable', compact('dbHeaders', 'headers', 'name'));
    }

    public function importData(Request $request) {
        event(new ImportDataEvent($request->all(), session('filePath')));
        return view('waiting');
    }

    public function validateCSV() { 
        return request()->validate([
            'csvFile' => 'required|mimes:csv,txt'
        ]);
    }

    public function getFileName($validatedFile) {
        $file = $validatedFile['csvFile'];  
        $fileName = $file->getClientOriginalName();
        return $fileName;
    }
    
    public function getFilePath($validatedFile) {
        $file = $validatedFile['csvFile']; 
        $path = $file->store('uploads','local');
        $fullPath = storage_path('app/' . $path);
        return $fullPath;
    }

    public function readFileHeaders($filePath) {
        $fileHeaders = str_getcsv(file($filePath)[0],';');
        array_unshift($fileHeaders, '');
        return $fileHeaders;      
    }    

    public function getDbHeaders() {
        return [
            "#",
            "Nome",
            "E-mail",
            "CPF / CNPJ",
            "Empresa",
            "Profissão / Cargo",
            "Telefone",
            "Cidade",
            "Estado",
            "País",
            "Status",
            "Estágio do Funil",
            "Título do Negócio",
            "Valor do Negócio",
            "Conversões",
            "Última Conversão",
            "Domínio",
            "Data de Cadastro",
            "URL"
        ];
    }
}



