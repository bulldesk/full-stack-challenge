<?php 

namespace App\Src\Importacao;

use App\Src\Parser\Csv\CsvParser;
use App\Leads;

class ImportacaoCsv{
    
    protected $assoc;
    protected $url;

    public function importar(){

        $csvParser = new CsvParser($this->url, ";");     
        $csvParser->parse();
        $rows = $csvParser->getData();
  
        foreach($rows as $row){
           
            $lead = new Leads(); 
            foreach($this->assoc as $key => $value){
                $lead->$value = $row->$key;
              
            }
            $lead->save();
        }
    }

    public function setAssoc(array $assoc){
        return $this->assoc = $assoc;
    }
    
    public function setUrl(String $url){
        return $this->url = $url;
    }

    public function getUrl(){
        return $this->url;
    }

    public function getAssoc(){
        return $this->assoc;
    }

}