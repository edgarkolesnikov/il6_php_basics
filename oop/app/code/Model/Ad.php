<?php

namespace Model;

use Helper\DBHelper;

class Ad
{
    private $id;

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
    public function getId()
    {
        return $this->id;
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




    public function save()
    {
        if(isset($this->id)){
            $this->update();
        }else{
            $this->create();
        }
    }

    public function update()
    {
        $db = new DBHelper();
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' => $this->typeId,
            'user_id' => $this->userId,
            'image' => $this->image,
            'active' => 1
        ];

        $db->update('ads', $data)->where('id', $this->id)->exec();
    }

    public function create()
    {
        $db = new DBHelper();
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' => $this->typeId,
            'user_id' => $this->userId,
            'image' => $this->image,
            'active' => 1
        ];
        $db->insert('ads', $data)->exec();
    }

    public function load($id)
    {
        $db = new DBHelper();
        $ad = $db->select()->from('ads')->where('id', $id)->getOne();
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
            $this->getActive = $ad['active'];
        }
        return $this;
    }

    public static function getAllAds()
    {
        $db = new DBHelper();
        $data= $db->select()->from('ads')->get();
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