<?php

declare(strict_types=1);
namespace Controller;

use Core\AbstractControler;
use Core\Interfaces\ControllerInterface;
use Helper\Url;
use Model\Ad;

class Import extends AbstractControler implements ControllerInterface
{
    public function index()
    {

    }

    public function execute(){
        $data = [];
        $file = fopen('../var/data.csv', 'r');
        while (!feof($file)){
            $line = fgetcsv($file);
            if(!empty($line)){
                $data[] = $line;
            }
        }
        fclose($file);

        foreach($data as $element){
            $slug = URL::slug((string)$element[0]);
            while(!Ad::isValueUnic('slug', $slug)){
                $slug = $slug . rand(0,100);
            }
            $ad = new Ad();
            $ad->setTitle($element[0]);
            $ad->setDescription($element[1]);
            $ad->setManufacturerId(1);
            $ad->setModelId(1);
            $ad->setPrice((float)$element[2]);
            $ad->setYear($element[3]);
            $ad->setTypeId(1);
            $ad->setUserId($_SESSION['user_id']);
            $ad->setImage($element[4]);
            $ad->setActive(1);
            $ad->setSlug($slug);
            $ad->setVisitor(0);
            $ad->setVinCode('123');
            $ad->setDate(date('Y/m/d'));
            $ad->save();
            echo "<br>";
            echo $element[0].' '. 'Added';
        }
        unlink('../var/data.csv');
    }


}