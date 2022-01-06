<?php
//if($_POST) {
//    $email = $_POST['email'];
//
//    function isEmailValid($email)
//    {
//        if (strpos($email, '@')) {
//            return true;
//        } else {
//            return false;
//        }
//    }
//
//    if (isEmailValid($email)) {
//        echo "emailas veikia";
//    } else {
//        echo "emailas negeras";
//    }
//}
//      222            budas su if kaip suskaiciuoti du skaicius
//if($_POST){
//    if($_POST["veiksmas"] == "+"){
//        echo $_POST["number"] + $_POST["number2"];}
//
//     if($_POST["veiksmas"] == "-") {
//         echo $_POST["number"] - $_POST["number2"];
//     }
//     if($_POST["veiksmas"] == "*") {
//         echo $_POST["number"] * $_POST["number2"];
//     }
//     if($_POST["veiksmas"] == "/"){
//        echo $_POST["number"] / $_POST["number2"];
//    }
//}
//      111        budas su switch kaip suskaiciuoti du skaicius
if($_POST){
    switch($_POST['veiksmas']){
        case "+":
            echo $_POST['number'] + $_POST['number2'];
            break;
        case "-":
            echo $_POST['number'] - $_POST['number2'];
            break;
        case "*":
            echo $_POST['number'] * $_POST['number2'];
            break;
        case "/":
            echo $_POST['number'] / $_POST['number2'];
            break;
        default:
            echo "neiseina";
            break;
    }
}



