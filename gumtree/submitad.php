<?php


$servername = "localhost";
$username = "root";
$password = "root";
$dbName = 'pamokos';
//padarom connectiona su DB
try {
    $conn = new PDO("mysql:host=$servername;dbname=".$dbName, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

//idedam i DB kai paspausta submit(create).
if(isset($_POST['create'])){
    $title = $_POST['title'];
    $content = $_POST['content'];
    $price = $_POST['price'];
    $year = $_POST['year'];

    $sql = 'INSERT INTO ads (title, description, manufacturer_id, model_id, price, year, type_id, user_id) 
            VALUES ("'.$title.'", "'.$content.'", 1, 1, '.$price.', '.$year.', 1, 1)';

    echo $sql;
    $conn->query($sql);

}