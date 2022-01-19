<?php
function writeToCsv($data, $fileName){
    $file = fopen($fileName, 'a');
    foreach($data as $element){
        fputcsv ($file, $element);
    }
    fclose ($file);
}

function getResults(){
    $file = fopen('result.csv', 'r');
    $data =[];
    while(!feof($file)){
        $data[]=fgetcsv($file);
    }
    return $data;
}

function debug($data){
    echo '<pre>';
    var_dump($data);
    die();
}
