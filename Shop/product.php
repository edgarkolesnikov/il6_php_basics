<?php
include 'helper.php';

$id = $_GET['id'];
$product = getProductById($id);

echo $product['name']. "<pre>" . $product['price'];

