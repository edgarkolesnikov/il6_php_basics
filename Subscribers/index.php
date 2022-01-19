<?php
include 'helper.php';
?>
<html>
<head><title>Subscribe</title></head>
<body>
<h2>Prenumeruoti</h2>
<form action="" method="post">
    <input type="email" name="email" placeholder="john@gmail.com">
    <input type="submit" value="prenumeruoti" name="subscribe" >
</form>
</body>
</html>
<?php

$email = clearEmail($_POST['email']);
if(isEmailValid($email) && isValueUniq($email, EMAIL_FIELD_KEY) && isset($_POST['subscribe'])){
    $data = [];
    $data[]=[$email];
    writeToCsv($data,'subscribers.csv');
    echo "Uzprenumeruota"."<br>";
}else{
    echo "Pasitikrinkite savo Email"."<br>";
}
