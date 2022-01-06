<?php
include 'helper.php';


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

$email = clearEmail($email);

if(isPasswordValid($password1, $password2) && isEmailValid($email)){
    $data = [];
    $data[] = [$first_name, $last_name, $email, $password1];
    writeToCsv($data, 'users.csv');
}else{
    echo 'Neteisingi duomenys';
}