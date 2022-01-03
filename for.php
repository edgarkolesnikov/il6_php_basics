<?php
//
//for ($y = 0; $y < 10; $y++){
//    for($x = 0; $x < 10; $x++){
//        if($y % 2 == 0) {
//            if($x % 2 == 0){
//                echo '#';
//            } else {
//                echo '.';
//            }
//        }else{
//            echo '#';
//        }
//    }
//    echo '<br>';
//}
for($years = 2015; $years < 2022; $years++){
    for($months = 1; $months <= 12; $months++){
        if($months == 1 || $months == 3 || $months == 5 || $months == 8 || $months == 10 || $months == 12){
            $to = 31;
        }elseif($months == 2){
            if($years % 4 == 0){
                $to = 29;
            }else{
                $to = 28;
            }
        }else{
            $to = 30;
        }
        for($day = 1; $day <= $to; $day++){
            echo $years.' '.$months.' '.$day;
            echo '<br>';
        }
        echo "<br>";
    }}





//for($years = 2015; $years < 2022; $years++){
//    for($months = 1; $months <=12; $months++) {
//        for ($day = 1; $day <= 31; $day++) {
//            echo '<br>';
//            if($months == 0){
//                echo $years .' '.$months.' '.$day - 1;
//            }elseif($months == 2) {
//                echo $years . ' ' . $months . ' ' . $day - 2;
//            }else {
//                echo $years . ' ' . $months . ' ' . $day;
//            }
//
//        } echo '<br>';
//    }
//}

