<?php
include 'parts/header.php';
?>

<html>
<head><title>Registracija</title></head>
<body>
<hr>
<h2>Registracijos forma</h2>
<form action="" method="post">
    <input type="text" name="first_name" placeholder="Vardas"><br>
    <input type="text" name="last_name" placeholder="Pavarde"><br>
    <input type="email" name="email" placeholder="Emailas"><br>
    <input type="password" name="password1" placeholder="Slaptazodis"><br>
<!--    <input type="password" name="password2" placeholder="Pakartokite slaptazodi"><br>-->
    <input type="number" name="number" placeholder="Tel.Nr." ><br>
<!--    <input type="text" name="city" placeholder="Miestas" ><br>-->
    <label for="agree_terms">Sutinku su registracijos taisyklemis.</label>
    <input type="checkbox" name="agree_terms" id="agree_terms">
    <input type="submit" value="create" name="create">
</form>

</body>
</html>
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
if(isset($_POST['create'])){
    $name = $_POST['first_name'];
    $surname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $number = $_POST['number'];
//    $city = $_POST['city'];

    $sql = 'INSERT INTO users(name, last_name, email, password, phone, city_id)
VALUES("'.$name.'","'.$surname.'","'.$email.'","'.$password.'","'.$number.'", 1)';

//    echo $sql;
    $conn->query($sql);
}
