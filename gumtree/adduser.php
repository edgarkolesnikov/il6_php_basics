<?php include 'parts/header.php';
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
if(isset($_POST['create'])){
    $name = $_POST['first_name'];
    $surname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $number = $_POST['number'];
    $city = $_POST['city'];

    $sql = 'INSERT INTO users(name, last_name, email, password, phone, city_id, created_at)
VALUES("'.$name.'","'.$surname.'","'.$email.'","'.$password.'","'.$number.'", "'.$city.'" , NOW())';

//    echo $sql;
    $conn->query($sql);
    die;
}

