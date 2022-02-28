<?php

namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Model\Url;

class Ad extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'ads';

    private $title;

    private $description;

    private $manufacturerId;

    private $modelId;

    private $price;

    private $year;

    private $typeId;

    private $userId;

    private $image;

    private $active;

    private $slug;

    private $vinCode;

    private $date;

    private $visitor;

    /**
     * @return mixed
     */
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * @param mixed $visitor
     */
    public function setVisitor($visitor): void
    {
        $this->visitor = $visitor;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getVinCode()
    {
        return $this->vinCode;
    }

    public function setVinCode($vinCode)
    {
        $this->vinCode = $vinCode;
    }

    /**
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @param mixed $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    /**
     * @param mixed $manufacturerId
     */
    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturerId = $manufacturerId;
    }

    /**
     * @return mixed
     */
    public function getModelId()
    {
        return $this->modelId;
    }

    /**
     * @param mixed $modelId
     */
    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getTypeId()
    {
        return $this->typeId;
    }

    /**
     * @param mixed $typeId
     */
    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function __construct($id = null)
    {
        if($id !== null){
            $this->load($id);
        }
    }

    public function assignData()
    {
        $this->data =  [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' => $this->typeId,
            'user_id' => $this->userId,
            'image' => $this->image,
            'active' => $this->active,
            'slug' => $this->slug,
            'vin_code' => $this->vinCode,
            'date' => $this->date,
            'visitor' => $this->visitor
        ];
    }

    public function load($id)
    {
        $db = new DBHelper();
        $ad = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        if(!empty($ad)){
            $this->id = $ad['id'];
            $this->title = $ad['title'];
            $this->manufacturerId = $ad['manufacturer_id'];
            $this->description = $ad['description'];
            $this->modelId = $ad['model_id'];
            $this->price = $ad['price'];
            $this->year = $ad['year'];
            $this->typeId = $ad['type_id'];
            $this->userId = $ad['user_id'];
            $this->image = $ad['image'];
            $this->active = $ad['active'];
            $this->slug = $ad['slug'];
            $this->vinCode = $ad['vin_code'];
            $this->date = $ad['date'];
            $this->visitor = $ad['visitor'];

        }
        return $this;
    }
    public function loadBySlug($slug)
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('slug', $slug)->getOne();
        if(!empty($rez)){
            $this->load($rez['id']);
            return $this;
        }else{
            return false;
        }
    }

    public static function getAllAds($page = null, $limit = null)
    {
        $db = new DBHelper();
        $data= $db->select()->from(self::TABLE)
            ->where('active', 1);
        if($limit != null){
            $db->limit($limit);
        }
        if($page != null){
            $db->offSet($page);
        }
        $data = $db->get();
        $ads = [];
        foreach($data as $element)
        {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getAdsForAdmin($page = null, $limit = null)
    {
        $db = new DBHelper();
        $data= $db->select()->from(self::TABLE);
        if($limit != null){
            $db->limit($limit);
        }
        if($page != null){
            $db->offSet($page);
        }
        $data = $db->get();
        $ads = [];
        foreach($data as $element)
        {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getLatest()
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('active',1)
            ->orderBy('id', 'DESC')
            ->limit(5)->get();
        $ads = [];
        foreach($data as $element)
        {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

    public static function getPopularAds($limit)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('active', 1)
            ->orderBy('visitor', 'DESC')
            ->limit($limit)->get();
        $ads = [];
        foreach($data as $element)
        {
            $ad = new Ad();
            $ad->load($element['id']);
            $ads[] = $ad;
        }
        return $ads;
    }

}