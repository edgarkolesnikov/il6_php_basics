<?php

$array =[1,2,[3,3,[4,4,3,2,3,[3,4,2,1]],2],3,5];
$sum = 0;




function sumArray($array){
    $sum = 0;
    foreach($array as $element){
        if(is_array($element)){
            $sum = $sum + sumArray($element);
        }else{
            $sum = $sum + $element;
        }
    }
    return $sum;
}

echo sumArray($array);
