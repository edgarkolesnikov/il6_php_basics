<?php

namespace Controller;

use Helper\Url;
use Helper\DBHelper;
use Helper\FormHelper;
use Model\Ads as Ads;



class Catalog
{
//    public function show($id = null)
//    {
//        if ($id !== null) {
//            echo 'Catalog controller ID ' . $id;
//        }
//    }
//
//    public function all($id)
//    {
//        for ($i = 0; $i < 10; $i++) {
//            echo '<a href="http://127.0.0.1:8000/oop/index.php/catalog/all/' . $i . '">Read more</a>';
//            echo '<br>';
//        }
//    }

    public function create()
    {
        if (!isset($_SESSION['user_id'])) {
            Url::redirect('user/login');
        } else {
            true;
        }

        $form = new FormHelper('catalog/insert', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Title',
        ]);
        $form->textArea('description', 'Aprasymas');

        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Price',
        ]);
        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Year',
        ]);


        $form->input([
            'name' => 'submit',
            'type' => 'submit',
            'placeholder' => 'Ikelti',
        ]);

        echo $form->getForm();


    }

    public function insert()
    {
        $userId = $_SESSION['user_id'];
        $ad = new Ads();
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($userId);

        $ad->save();
        Url::redirect('catalog/create');



    }

    public function update()
    {
        $userId = $_SESSION['user_id'];
        $ad = new Ads();
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId('1');
        $ad->setModelId('1');
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId('1');
        $ad->setUserId($userId);
        Url::redirect('catalog/create');

        $ad->save();

    }

    public function load()
    {
        $data = new ads();
        $data->load($this->getId)->exec();

    }
}