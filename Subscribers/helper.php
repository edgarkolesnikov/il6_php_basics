<?php
const EMAIL_FIELD_KEY =0;

function writeToCsv($data, $fileName){
    $file = fopen($fileName, 'a');
    foreach($data as $element){
        fputcsv ($file, $element);
    }
    fclose ($file);
}
function readFromCsv($fileName){
    $data = [];
    $file = fopen($fileName, 'r');
    while (!feof($file)){
        $line = fgetcsv($file);
        if(!empty($line)){
            $data[] = $line;
        }
    }
    fclose($file);
    return $data;
}


function isValueUniq($value, $key)
{
    $users = readFromCsv('subscribers.csv');
    foreach($users as $user){
        if($user[$key] === $value){

            echo "Toks Email jau egzistuoja"."<br>";
            return false;

        }
    }
    return true;
}


function clearEmail($email){
    return trim(strtolower($email));
}

function isEmailValid($email){
    return strpos($email,'@')!==false;
}
