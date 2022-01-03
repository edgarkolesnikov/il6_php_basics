<?php


// kintamieji
$string = 'Hello world';
$productName = 'Rudeniniai Batai Rudi';
$productDescription = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.';
$productBrand = 'nike';
$symbol = '@';
$number = '1';


//sveiki skaiciai
$integer = 1;
$integer2 = 123;
$integer3 = 233232;

$productQty = 4;

//
$productPrice = 67.99;
$size = 41.5;
$weight = 0.234;

//boolean - true / false
$isInStock = true;
$waterProof = true;
$airless = false; //ar kvepuoja ir pan.

// masyvai / array
echo "<pre>"; //Graziai atspausdina stulpelyje

//tarkim kad nera reiksmes
$null = null;

$product = [
    'name' => $productName,
    'qty' => $productQty,
    'price' => $productPrice,
    'water_proof' => $waterProof
];
$product2 = [
    'name' => 'Vasariniai batai',
    'qty' => 1,
    'price' => 87.99,
    'water_proof' => true
];
$products = [$product, $product2];

//print_r($products);
//
//echo $product ['name'];
//echo $product ['price'];
//echo '<br>';
//echo $product2 ['name'];
//echo $product2 ['price'];

//echo $productName;
//echo '<br>';
//echo $productDescription;
//echo '<br>';
//echo $productBrand;


// + - / * %
// % - liekana  - jei 7 / 2 = lygu 2, o liekana 1, todel echo bus 1

$x = 7;
$y = 2;

$z = $x % $y;
echo $z;
echo "<br>";
?>
<form action="" method="POST">
    <input type="submit" value="0" name="mybutton">
    <input type="submit" value="1" name="mybutton">
    <input type="submit" value="2" name="mybutton">
</form>

<?php
if (isset($_POST["mybutton"]))
{
    echo $_POST["mybutton"];
}
?>


