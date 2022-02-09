<?php

namespace Controller;

use Core\AbstractControler;
use Helper\FormHelper;
use Helper\Url;
use Model\Ad;
use Model\User as UserModel;

class Catalog extends AbstractControler
{
    public function add()
    {

        if (!isset($_SESSION['user_id'])) {
            Url::redirect('');
        }
        $form = new FormHelper('catalog/create', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Pavadinimas'
        ]);

        $form->textArea('description', 'Aprasymas');
        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Kaina'
        ]);
        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai'
        ]);
        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Nuoroda nuotraukai'
        ]);

        $form->input([
            'name' => 'active',
            'type' => 'text',
            'placeholder' => 'Aktyvus/neaktyvus'
        ]);


        $form->input([
            'type' => 'submit',
            'value' => 'sukurti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('catalog/create');

    }

    public function create()
    {
        $ad = new Ad();
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_SESSION['image']);
        $ad->setActive($_SESSION['active']);
        $ad->save();
        Url::redirect('catalog/all');
    }

    public function edit($id)
    {
        if(!($_SESSION['user_id'])){
            Url::redirect('');
        }
        $ad = new Ad();
        $ad->load($id);
        if($_SESSION['user_id'] != $ad->getUserId()){
            Url::redirect('');
        }

        $form = new FormHelper('catalog/update', 'POST');
        $form->input([
            'name' => 'title',
            'type' => 'text',
            'placeholder' => 'Pavadinimas',
            'value' => $ad->getTitle()
        ]);

        $form->input([
            'name' => 'id',
            'type' => 'hiden',
            'value' => $ad->getId()

        ]);

        $form->textArea('description', $ad->getDescription());
        $form->input([
            'name' => 'price',
            'type' => 'text',
            'placeholder' => 'Kaina',
            'value' => $ad->getPrice()
        ]);
        $form->input([
            'name' => 'year',
            'type' => 'text',
            'placeholder' => 'Metai',
            'value' => $ad->getYear()
        ]);

        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Nuoroda nuotraukai',
            'value' => $ad->getImage()
        ]);

        $form->input([
            'name' => 'active',
            'type' => 'number',
            'placeholder' => 'Aktyvus/Neaktuvus',
            'value' => $ad->getActive()
        ]);

        $form->input([
            'type' => 'submit',
            'value' => 'atnaujinti',
            'name' => 'create'
        ]);

        $this->data['form'] = $form->getForm();
        $this->render('catalog/create');
    }

    public function update()
    {
        $adId = $_POST['id'];
        $ad = new Ad();
        $ad->load($adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_POST['image']);
        $ad->setActive($_POST['active']);
        $ad->save();
    }



    public function all()
    {
        $this->data['ads'] = Ad::getAllAds();
        $this->render('catalog/list');
    }

    public function show($id)
    {
        $ad = new Ad();
        $ad->load($id);

        $user = new UserModel();
        $user->load($ad->getUserId());

        $this->data['ads'] = '<h2>' . $ad->getTitle() . '</h2><br><br>' .
            '<img width="400" src=" ' .$ad->getImage(). '">' .
            '<h3>Description</h3>' . $ad->getDescription() . '<br>' .
            '<br>Manufacturer: ' . $ad->getManufacturerId() . '<br>' .
            'Model: ' . $ad->getModelId() . '<br>' .
            'Price: ' . $ad->getPrice() . ' Eur<br>' .
            'Year of manufacture: ' . $ad->getYear() . '<br>' .
            'Type: ' . $ad->getTypeId() . '<br>' .
            'Created by: ' . ucfirst($user->getName()) . ' ' .
            ucfirst($user->getLastName()) . '<br>';

        $this->render('catalog/show');
    }


}