<?php
include 'helper.php';


$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];

$email = clearEmail($email);

$users = readFromCsv('users.csv');

//foreach($users as $user) {
//    if ($email === $user[3]) {
//        echo "Toks email jau egzistuoja". " ".  "<a href='index.php'>Grizti</a>";
//        return false;
//    }
//}
//foreach($users as $user) {
//    if ($nick_name === $user[2]) {
//        $nick_name = $nick_name.rand(0,100);
//    }
//}

if(
    isPasswordValid($password1, $password2) &&
    isEmailValid($email) &&
    isValueUniq($email, EMAIL_FIELD_KEY) &&
    isset($_POST['agree_terms'])){

    $nickName = generateNickName($first_name, $last_name);
    while(!isValueUniq($nickName, NICKNAME_FIELD_KEY)){
        $nickName = $nickName . rand(0.100);
    }
    $data = [];
    $password1 = hashPassword($password1);

    $data[] = [$first_name, $last_name, $email, $password1, $nickName];
    writeToCsv($data, 'users.csv');
}else{
    echo 'Slaptazodziai turi sutapti' ." ".  "<a href='index.php'>Grizti</a>";
}

