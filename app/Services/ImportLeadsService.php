<?php

namespace App\Services;

use App\Jobs\InsertLeads;

class ImportLeadsService
{
    protected $file;
    protected $path;

    /**
     * ImportLeadsService constructor.
     */
    public function __construct($file, $path)
    {
        $this->file = $file;
        $this->path = $path;
        $this->import();
    }

    /**
     * Serviço de leitura formatação dos dados para enviar ao banco
     */
    public function import()
    {
        $filepath = storage_path('app/' . $this->path);
        $file     = fopen($filepath, "r");
        $headers  = multiexplode(fgetcsv($file, 1000)[0]);
        $data     = array();

        while (($fileData = fgetcsv($file, 1000, ",")) !== FALSE) {

            $num  = count($fileData);

            for ($c = 0; $c < $num; $c++) {

                $values = multiexplode($fileData[$c], 'value');

                foreach ($values as $key => $value) {

                    $field = sanitizeFields(utf8_encode($headers[$key]));

                    $data[$field] = $value;
                }

                InsertLeads::dispatch($data);
            }
        }
        fclose($file);

    }
}