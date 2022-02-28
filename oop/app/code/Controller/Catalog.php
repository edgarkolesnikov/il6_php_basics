<?php

namespace Controller;

use Core\AbstractControler;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Url;
use Model\Ad;
use Model\Comments;
use Model\User as UserModel;
use Helper\Logger;
use Core\Interfaces\ControllerInterface;

class Catalog extends AbstractControler implements ControllerInterface
{
    public function index()
    {
        $this->data['count'] = Ad::count();
        $page = 0;
        if(isset($_GET['p'])){
            $page = (int)$_GET['p'] -1;
        }

        $this->data['ads'] = Ad::getAllAds($page * 3, 3);
        $this->render('catalog/list');


//        if(isset($_GET['pageno'])){
//            $pageno = $_GET['pageno'];
//        } else {
//            $pageno = 1;
//        }
//
//        $nomberPerPage = 10;
//        $offset = ($pageno - 1) * $nomberPerPage;
//
//        $db = new DBHelper();
//        $data = $db->selectCount()->from('ads')->get();
//        return $data;
//        $totalRows = mysqli_fetch_array($data)[0];
//        $total_pages = ceil($totalRows / $nomberPerPage);
//
//        $rez = $db->select()->from('ads')->limit($offset, $nomberPerPage)->get();
//        return $rez;

    }

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
            'name' => 'vin_code',
            'type' => 'text',
            'placeholder' => 'Vin'
        ]);
        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Nuoroda nuotraukai'
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

        $slug = Url::slug($_POST['title']);
        while(!Ad::isValueUnic('slug', $slug))
        {
            $slug = $slug.rand(0,100);
        }

        $ad = new Ad();
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice($_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_POST['image']);
        $ad->setActive(1);
        $ad->setSlug($slug);
        $ad->setVinCode($_POST['vin_code']);
        $ad->setDate(date('Y/m/d'));
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
            'name' => 'vin_code',
            'type' => 'text',
            'placeholder' => 'Vin',
            'value' => $ad->getVinCode()
        ]);

        $form->input([
            'name' => 'image',
            'type' => 'text',
            'placeholder' => 'Nuoroda nuotraukai',
            'value' => $ad->getImage()
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
        $ad->setVinCode($_POST['vin_code']);
        $ad->save();
    }





    public function show($slug)
    {
        $ad = new Ad();
        $this->data['ad'] = $ad->loadBySlug($slug);
        $this->data['title'] = $ad->getTitle();
        $this->data['meta_description'] = $ad->getDescription();
        if($this->data['ad']){
            $ad->setVisitor($ad->getVisitor() + 1);
            $ad-> save();
            $form = new FormHelper('catalog/createComment', 'POST');
            $form->textArea('comment', 'Komentaras');
            $form->input([
                'name' => 'button',
                'type' => 'submit',
                'placeholder' => 'komentuoti'
            ]);
            $form->input([
                'name' => 'id',
                'type' => 'hidden',
                'value' => $ad->getId()
            ]);
            $this->data['comment'] = $form->getForm();
            $this->data['comments'] = Comments::getAdComments($ad->getId());

            $this->render('catalog/show');

        }else{
            $this->render('parts/errors/error404');
        }
    }

    public function createComment()
    {
        $comment = new Comments();
        $comment->setUserId($_SESSION['user_id']);
        $comment->setMessage($_POST['comment']);
        $comment->setIp($_SERVER['REMOTE_ADDR']);
        $comment->setadId($_POST['id']);
        $comment->setDate(DATE('Y/m/d'));
        $comment->save();

        $ad = new Ad();
        $ad->load($_POST['id']);
        Url::redirect('catalog/show/'.$ad->getSlug());

    }

//    public function search($value)
//    {
//        $db = new DBHelper();
//        $rez = $db->select()->from('ads')
//            ->where('title', $value)
//            ->andWhere('description', $value)
//            ->get();
//        if($rez){
//            return $rez['id'];
//        }else{
//            echo 'Irasu nera';
//        }
//    }



}