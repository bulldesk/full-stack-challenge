<?php

function sanitizeFields($field)
{

    $characters = str_replace("/",' ', $field);
    $spaces     = str_replace(" ",'', $characters);
    $accents    = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"), $spaces);

    return strtolower($accents);

}

function multiexplode($string, $value = null)
{

    $delimiters = array(',', ';', "\t", '|');

    $ready  = str_replace($delimiters, $delimiters[0], $string);
    $launch = explode($delimiters[0], $ready);

    if (!is_null($value)) {

        if (isset($launch[19])) {
            $company = array($launch[4], $launch[5]);
            $launch[4] = implode(',', $company);
            unset($launch[5]);
            $launch = array_values($launch);
        }
    }

    return  $launch;
}
