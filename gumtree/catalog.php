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
//        print_r($ads);
?>
<html>
    <body>
    <?php foreach($ads as $ad) : ?>
<div class="product-wrap">
    <div class="name">
        <?php echo $ad['title']. '<pre>'. $ad['description'] .'<pre>'.$ad['price'];?>
    </div>
    <hr>
</div>
<?php endforeach ?>
    </body>






<?php include 'parts/footer.php'; ?>