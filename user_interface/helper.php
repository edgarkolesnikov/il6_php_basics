<?php
const EMAIL_FIELD_KEY = 2;
const NICKNAME_FIELD_KEY = 4;

function clearEmail($email){
    return trim(strtolower($email));
}

function isEmailValid($email){
    return strpos($email, '@') !== false;
}

function isPasswordValid($pass1, $pass2){
    return $pass1 === $pass2 && strlen($pass1) > 8;
}

function hashPassword($password)
{
    return md5($password);
}

function generateNickName($userName, $userLastName){
    return strtolower(substr($userName, 0, 3).substr($userLastName, 0, 3)).mt_rand(1, 100);
}

//csv file, Write

function writeToCsv($data, $fileName){
    $file = fopen($fileName, 'a');
    foreach($data as $element){
        fputcsv ($file, $element);
    }
    fclose ($file);
}

//csv file, Read from csv

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
    $users = readFromCsv('users.csv');
    foreach($users as $user){
        if($user[$key] === $value){
            return false;
        }
    }
    return true;
}

//debugeris.
function debug($data){
    echo '<pre>';
    var_dump($data);
    die();
}