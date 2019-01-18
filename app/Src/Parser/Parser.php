<?php

namespace App\Src\Parser;

interface Parser{
    
    public function parse();
    public function getData();
    public function getHeaders();
    public function setFile(String $file);

}