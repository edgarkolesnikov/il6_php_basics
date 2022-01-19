<?php include 'parts/header.php';

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

$sql = 'SELECT * FROM ads';
    echo '<pre>';
    $rez = $conn->query($sql);
    $ads = $rez->fetchAll();
        print_r($ads);
?>
<html>




<?php include 'parts/footer.php'; ?>