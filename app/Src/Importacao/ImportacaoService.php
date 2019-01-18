<?php 

namespace App\Src\Importacao;

use App\Src\Parser\Parser;
use App\Leads;

class ImportacaoService
{
    
    protected $parser;
    protected $assoc;

    public function __construct(Parser $parser){
        $this->parser = $parser;
    }

    public function importar()
    {
        $this->parser->parse();
        $rows = $this->parser->getData();

        foreach($rows as $row){           
            $lead = new Leads(); 
            foreach($this->assoc as $key => $value){
                $lead->$value = $row->$key;   
            }
            $lead->save();
        }
    }

    public function setParser(Parser $parser)
    {
        $this->parser = $parser;
    }

    public function getHeaders()
    {
        $this->parser->parse();
        return $this->parser->getHeaders();
    }

    public function setAssoc(array $assoc)
    {
        $this->assoc = $assoc;
    }

}