<?php
include 'parts/header.php';

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
    $sql = 'SELECT * FROM cities';
//    echo '<pre>';
    $rez = $conn->query($sql);
    $cities = $rez->fetchAll();
//        print_r($cities)
        ?>
<html>
<head><title>Registracija</title></head>
<body>
<hr>
<h2>Registracijos forma</h2>
<form action="adduser.php" method="post">
    <input type="text" name="first_name" placeholder="Vardas"><br>
    <input type="text" name="last_name" placeholder="Pavarde"><br>
    <input type="email" name="email" placeholder="Emailas"><br>
    <input type="password" name="password1" placeholder="Slaptazodis"><br>
<!--    <input type="password" name="password2" placeholder="Pakartokite slaptazodi"><br>-->
    <input type="number" name="number" placeholder="Tel.Nr." ><br>
    <select name="city">
        <?php
            foreach($cities as $city){
                echo '<option value="'.$city['id'].'">'.$city['name'].'</option>';
            }
        ?>
    </select><br>
    <label for="agree_terms">Sutinku su registracijos taisyklemis.</label>
    <input type="checkbox" name="agree_terms" id="agree_terms">
    <input type="submit" value="create" name="create">
</form>

</body>
</html>


<?php include "parts/footer.php"; ?>