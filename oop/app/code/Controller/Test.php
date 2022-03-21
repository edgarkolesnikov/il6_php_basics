<?php

namespace Controller;

use Core\AbstractControler;
use Core\AbstractModel;
use Core\Interfaces\ControllerInterface;

class Test extends AbstractControler implements ControllerInterface
{
    public function index()
    {
        echo '<h1> Pirma uzduotis</h1>';
        $array = [1, 3, 4, 6, 9 ,2, 3, 4, 5, 5, 7, 8, 9, 10, 1, 4, 5,34, 23, 1, 4, 6, 77, 3, 9];
        $avg = array_sum($array)/count($array);
        $lowerThanAvg = [];
        $higherThanAvg = [];
        foreach($array as $key) {
            if($key < $avg){
                $lowerThanAvg[] = $key;
            }if($key >= $avg){
                $higherThanAvg[] = $key;
            }
        }
        $lowAvg = array_sum($lowerThanAvg)/count($lowerThanAvg);
        $highAvg = array_sum($higherThanAvg)/count($higherThanAvg);
        $lowCount = count($lowerThanAvg);
        $highCount = count($higherThanAvg);
        echo 'Bendras vidurkis = '. $avg . ' <pre>'.'Mazesniuju vidurkis = '. $lowAvg .'<pre>' . 'Didesniuju vidurkis = '. $highAvg;
        echo '<pre>'. 'Mazesniu uz vidurki yra:'.$lowCount. '<pre>'. 'Didesniu uz vidurki yra:'.$highCount.'<pre>';


        echo '<h1>Antra uzduotis</h1>';
        $newArray = [1000, 2303, 444, 5554, 9993, 45454, 4343, 65656, 65659, 43434, 92, 23456, 758595, 344433];
         $maxEven = (max(array_filter($newArray, function($var){return(!($var & 1));})));
         $newMax = $maxEven/100*60;
         echo 'Duotas masyvas:'. '<pre>';
         print_r($newArray);
         echo 'Didziausias lyginis skaicius: ' .$maxEven. '<pre>';
         echo 'Sumazintas 40% skaicius = '. $newMax. '<pre>';
        $updatedArray = array_replace($newArray,
            array_fill_keys(
                array_keys($newArray, $maxEven),
                $newMax));
        echo 'Naujas pakeistas masyvas:'.'<pre>';
        print_r($updatedArray);

    }

// Turime array:
// [1000, 2303, 444, 5554, 9993, 45454, 4343, 65656, 65659, 43434, 92, 23456, 758595, 344433]
// rasti didžiausią lyginį skaičių, sumažinti jį 40% ir atspauzdinti toki pat array, su pakeistu skaičiumi.



}



