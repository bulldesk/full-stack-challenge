<?php

namespace App\Src\Parser\Csv;

class CsvParser{

    protected $csv;
    protected $limit = 0;
    protected $delimiter;
	protected $valid_delimiters = array( ',', ';', "\t", '|', ':' );
    protected $data = array();
    protected $headers = array();
    protected $path;

    function __construct(String $csv = "", String $delimiter){
        ini_set('auto_detect_line_endings',TRUE);
        $this->csv = $csv;
        $this->delimiter = $delimiter;
        $this->path = storage_path('app')."/".$this->csv;
    }

    public function setCsv(String $csv){
        $this->csv = $csv;
    }
    
    public function getDelimiter(){
        return $this->delimiter;
    }

    public function setDelimeter(String $delimiter) {
	
		if(in_array($delimiter, $this->valid_delimiters) !== true) {
			throw new \InvalidArgumentException('Delimiter is not valid.');
		}
		$this->delimiter = $delimiter;
	}

    public function getData(){
        return $this->data;
    }
    
    public function getHeaders(){
        return $this->headers;
    }

	public function parse()
	{
     
		if (($handle = fopen($this->getPath(), "r")) !== FALSE) {
		
			$i = 0;

			while (($data = fgetcsv($handle, $this->getLimit(), $this->getDelimiter())) !== FALSE) {
				if ($data != null) {
					if ($i !== 0) {
						$this->data[] = (object) array_combine($this->headers, $data);
					} else {
						$this->headers = array_map(array($this,"_sanitize"), $data);
					}
					$i++;
				}
            }
            
			fclose($handle);
		}
    }

    public function _sanitize($string)
	{
		return preg_replace("/\xEF\xBB\xBF/", "", trim($string));
    }
    
    public function getPath(){
        return $this->path;
    }
    
    public function getLimit(){
        return $this->limit;
    }
}