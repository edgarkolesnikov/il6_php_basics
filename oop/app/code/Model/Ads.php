<?php

namespace Model;

use Helper\DBHelper;
use Helper\FormHelper;
use Model\User;


class ads
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


    public function getId()
    {
        return $this->id;
    }


    public function getTitle()
    {
        return $this->title;
    }


    public function setTitle($title)
    {
        $this->title = $title;
    }


    public function getDescription()
    {
        return $this->description;
    }


    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getManufacturerId()
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId($manufacturerId)
    {
        $this->manufacturerId = $manufacturerId;
    }

    public function getModelId()
    {
        return $this->modelId;
    }

    public function setModelId($modelId)
    {
        $this->modelId = $modelId;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function setYear($year)
    {
        $this->year = $year;
    }

    public function getTypeId()
    {
        return $this->typeId;
    }

    public function setTypeId($typeId)
    {
        $this->typeId = $typeId;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    public function setUserId($userId)
    {
        return $this->$userId;
    }


    public function save()
    {
        if (!isset($this->id)) {
            $this->create();
        } else {
            $this->update();
        }
    }

    public function create()
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' => $this->typeId,
            'user_id' => $_SESSION['user_id']
        ];
        $db = new DBHelper();
        $db->insert('ads', $data)->exec();

    }

    public function update($data)
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'manufacturer_id' => $this->manufacturerId,
            'model_id' => $this->modelId,
            'price' => $this->price,
            'year' => $this->year,
            'type_id' => $this->typeId,
            'user_id' => $this->userId
        ];


        $db = new DBHelper();
        $db->update('ads', $data)->where('id',$this->getId())->exec();

    }

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from('ads')->where('user_id', $id)->getOne();
        $this->id =$data['id'];
        $this->title=$data['title'];
        $this->manufacturerId=$data['manufacturer_id'];
        $this->modelId=$data['model_id'];
        $this->price=$data['price'];
        $this->year=$data['year'];
        $this->typeId=$data['type_id'];
        $this->userId=$data['user_id'];

        return $this;
    }

    public function delete()
    {
        $db= new DBHelper();
        $db->delete()->from('ads')->where('id', $this->id)->exec();

    }



}