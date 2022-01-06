<?php
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$name = $_POST['name'];
$surname = $_POST['surname'];

Echo "<h1>Registracija SEKMINGA</h1>";
echo "Vardas: ".$name. '<br>';
echo "Pavarde: ".$surname. '<br>';


function getNickName($name, $surname){
    $firstName = substr($name, 0,3);
    $firstSurname = substr($surname, 0 , 3);
    return strtolower($firstName.$firstSurname);
}
echo "Nick: ".getNickName($name, $surname). rand(1,100);
echo "<br>";

function clearEmail($email){
    $emailLowerCases = strtolower($email);
    return trim($emailLowerCases);
}
function isEmailValid($email){
    if (strpos($email, '@')) {
        return true;
    } else {
        return false;
    }
}
if(isEmailValid($email)){
    echo "El.paštas: ".clearEmail($email);
}else{
    echo 'Emailas nevalidus';
}
echo '<br>';

if($password === $confirmPassword){
    return true;
}else {
    echo "Slaptazodziai turi sutapti";
}

