<?php



$productPrice = 12;
$discount = 20;

$productPrice2 = 13;
$discount2 = 30;

$finalPrice = getFinalPrice($productPrice, $discount);
$finalPrice2 = getFinalPrice($productPrice2, $discount2);


//Single responsibilities - 1 dalykas atsakingas uz 1 dalyka, tarkim tik uz discounta atsakingas dalykas,
//jei butu ir discount ir pvm skaiciavimas, butu atsakinga tik uz viena is situ,


echo '<div class="price">'.$finalPrice .'</div>';
echo '<br>';
echo '<div class="price">'.$finalPrice2 .'</div>';

function getFinalPrice($price, $discount){
    $finalPriceWithoutTaxes = $price * ((100 - $discount) / 100);
    $finalPriceWithTaxes = getPriceWithTax($finalPriceWithoutTaxes);
    return $finalPriceWithTaxes;
    }
    function getPriceWithTax($price){
        return round($price * 1.21,2);

}

echo "<br>";

$userEmail1 = 'pvz11@gmail.com';
$userEmail2 = 'pvz2@gmail.com';
$userEmail3 = 'Pvz3333@gmail.com';

function clearEmail($email){
    $emailLowerCases = strtolower($email);
    return trim($emailLowerCases);
}

function isEmailValid($email){

    //return strpos($email, '@') !== false;   ----- cia one line code, tas pats kas sekantis if tik trumpai. sunkiai skaitomas.

    if (strpos($email, '@')) {
        return true;
    } else {
        return false;
    }
}
    if(isEmailValid($userEmail1)){
        echo clearEmail($userEmail1);
    }else{
        echo 'Emailas nevalidus';
    }
    echo '<br>';



//Iskirtpti pirmas 3 raides is vardo ir pavardes.
$name = 'Vardas';
$surname = 'Pavardenis';

function getNickName($name, $surname){
    $firstName = substr($name, 0,3);
    $firstSurname = substr($surname, 0 , 3);
    return $firstName.$firstSurname;
}
echo getNickName($name, $surname);



