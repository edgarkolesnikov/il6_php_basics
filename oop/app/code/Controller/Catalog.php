<?php
declare(strict_types=1);
namespace Controller;

use Core\AbstractControler;
use Helper\DBHelper;
use Helper\FormHelper;
use Helper\Url;
use Model\Ad;
use Model\Comments;
use Model\Memorised;
use Model\Rating;
use Model\User as UserModel;
use Helper\Logger;
use Core\Interfaces\ControllerInterface;

class Catalog extends AbstractControler implements ControllerInterface
{
    public function index(): void
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

    public function add(): void
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

    public function create(): void
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
        $ad->setPrice((float)$_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_POST['image']);
        $ad->setActive(1);
        $ad->setSlug($slug);
        $ad->setVinCode($_POST['vin_code']);
        $ad->setDate(date('Y/m/d'));
        $ad->setVisitor(0);
        $ad->save();
        Url::redirect('catalog');
    }

    public function edit(int $id): void
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

    public function update(): void
    {
        $adId = $_POST['id'];
        $ad = new Ad();
        $ad->load((int)$adId);
        $ad->setTitle($_POST['title']);
        $ad->setDescription($_POST['description']);
        $ad->setManufacturerId(1);
        $ad->setModelId(1);
        $ad->setPrice((float)$_POST['price']);
        $ad->setYear($_POST['year']);
        $ad->setTypeId(1);
        $ad->setUserId($_SESSION['user_id']);
        $ad->setImage($_POST['image']);
        $ad->setVinCode($_POST['vin_code']);
        $ad->save();
        Url::redirect('catalog/show/'.$ad->getSlug());
    }


    public function show(string $slug)
    {
        $ad = new Ad();

        if($ad->loadBySlug($slug) === null){
            $this->render('parts/errors/error404');
            return;
        }

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
            $this->data['rated'] = false;
            $rate = new Rating();
            $isRateNull = $rate->loadByUserAndAd($_SESSION['user_id'], $ad->getId());
            if($isRateNull !== null){
                $this->data['rated'] = true;
                $this->data['user_rate'] = $rate->getRating();
            }

            $ratings = Rating::getRatingsByAd($ad->getId());
            $sum = 0;
            foreach($ratings as $rate){
                $sum += $rate['rating'];
            }
            $this->data['ad_rating'] = 0;
            $this->data['rating_count'] = count($ratings);
            if($sum > 0){
                $this->data['ad_rating'] = $sum / $this->data['rating_count'];
            }
            $this->data['comment'] = $form->getForm();
            $this->data['comments'] = Comments::getAdComments($ad->getId());
            $this->data['ad'] = $ad;
            $this->data['title'] = $ad->getTitle();
            $this->data['meta_description'] = $ad->getDescription();

            $this->render('catalog/show');



    }

    public function createComment(): void
    {
        $comment = new Comments();
        $comment->setUserId($_SESSION['user_id']);
        $comment->setMessage($_POST['comment']);
        $comment->setIp($_SERVER['REMOTE_ADDR']);
        $comment->setAdId($_POST['id']);
        $comment->setDate(DATE('Y/m/d'));
        $comment->save();

        $ad = new Ad();
        $ad->load((int)$_POST['id']);
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

    public function rateAd()
    {
        $rate = new Rating();
        $userId = $_SESSION['user_id'];
        $adId = $_POST['ad_id'];
        $value = $_POST['rating'];
            $rate -> setUserId((int)$userId);
            $rate -> setAdId((int)$adId);
            $rate -> setRating((int)$value);
            $rate -> save();
            $ad = new Ad();
            $ad->load((int)$_POST['ad_id']);
            Url::redirect('catalog/show/'.$ad->getSlug());
    }

    public function rate()
    {
        $rate = new Rating();
        $rate->loadByUserAndAd($_SESSION['user_id'], (int)$_POST['ad_id']);
        $rate->setUserId((int)$_SESSION['user_id']);
        $rate->setAdId((int)$_POST['ad_id']);
        $rate->setRating((int)$_POST['rate']);
        $rate->save();
        $ad = new Ad();
        $ad->load((int)$_POST['ad_id']);
        Url::redirect('catalog/show/'.$ad->getSlug());

    }

    public function memorise()
    {
        $memory = new Memorised();
        $memory->setUserId((int)$_SESSION['user_id']);
        $memory->setAdId((int)$_POST['ad_id']);
        $memory->save();
        $ad = new Ad();
        $ad->load((int)$_POST['ad_id']);
        Url::redirect('catalog/show/'.$ad->getSlug());

//        $this->data['form'] = $form->getForm();
//        $this->render('Memorised/list');
    }

    public function memorisedAds()
    {
        $this->data['ads'] = Memorised::getMemorisedAds($_SESSION['user_id']);
        $this->render('Memorised/list');
    }

    public function forget()
    {
        $userId = $_SESSION['user_id'];
        $adId = $_POST['ad_id'];
        $favourites = new Memorised();
        $favourites-> loadByUserAndAd($userId, $adId);
        $favourites->delete();
        $ad = new Ad();
        $ad->load((int)$_POST['ad_id']);
        Url::redirect('catalog/show/'.$ad->getSlug());
    }

    public function deleteFromFavourites()
    {
        $userId = $_SESSION['user_id'];
        $adId = $_POST['ad_id'];
        $favourites = new Memorised();
        $favourites-> loadByUserAndAd($userId, $adId);
        $favourites->delete();
        $ad = new Ad();
        $ad->load((int)$_POST['ad_id']);
        Url::redirect('catalog/memorisedAds');
    }
}