<?php
include "parts/header.php";

$email =$_POST['email'];
$userPassword = md5($_POST['password']);


$servername = "localhost";
$username = "root";
$password = "root";
$dbName = 'pamokos';
//padarom connectiona su DB
try {
    $conn = new PDO("mysql:host=$servername;dbname=".$dbName, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$sql = 'SELECT * FROM users WHERE email="'.$email.'" AND password = "'.$userPassword.'"';

$rez = $conn->query($sql);
$user = $rez->fetchAll();
//
//print_r($user);

if(!empty($user)){

}else{
    echo "Neteisingi duomenys";
}

include "parts/footer.php";