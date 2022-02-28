<?php include "parts/header.php";

$id = $_GET['id'];

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

$sql = "SELECT * FROM ads WHERE id=$id";
    echo '<pre>';
$rez = $conn->query($sql);
$ads = $rez->fetchAll();
//          print_r($ads);
foreach($ads as $ad){
    echo 'Title: '.$ad['title'].'<pre>';
    echo 'Description: '.$ad['description'].'<pre>';;
    echo 'Price: '.$ad['price'].'$'.'<pre>';;
    echo 'Year: '.$ad['year'].'<pre>';;
    echo 'Manufacture: '.$ad['manufacturer_id'].'<pre>';
    echo 'Seller: '.$ad['user_id'].'<pre>';
    echo '<pre>';
}