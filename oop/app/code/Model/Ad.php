<?php

namespace Model;

use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;
use Model\Url;

class Ad extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'ads';

    private string $title;

    private string $description;

    private int $manufacturerId;

    private int $modelId;

    private float $price;

    private int $year;

    private int $typeId;

    private int $userId;

    private string $image;

    private int $active;

    private string $slug;

    private string $vinCode;

    private string $date;

    private int $visitor;


    public function getVisitor(): int
    {
        return $this->visitor;
    }

    public function setVisitor(int $visitor): void
    {
        $this->visitor = $visitor;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getVinCode(): string
    {
        return $this->vinCode;
    }

    public function setVinCode(string $vinCode): void
    {
        $this->vinCode = $vinCode;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug($slug): void
    {
        $this->slug = $slug;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }


    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getManufacturerId(): int
    {
        return $this->manufacturerId;
    }

    public function setManufacturerId(int $manufacturerId): void
    {
        $this->manufacturerId = $manufacturerId;
    }

    public function getModelId(): int
    {
        return $this->modelId;
    }

    public function setModelId(int $modelId): void
    {
        $this->modelId = $modelId;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function getTypeId(): int
    {
        return $this->typeId;
    }

    public function setTypeId(int $typeId): void
    {
        $this->typeId = $typeId;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function __construct($id = null)
    {
        if($id !== null){
            $this->load($id);
        }
    }

    public function assignData(): void
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

    public function load(int $id): object
    {
        $db = new DBHelper();
        $ad = $db->select()->from(self::TABLE)->where('id',$id)->getOne();
        if(!empty($ad)){
            $this->id = (int)$ad['id'];
            $this->title = $ad['title'];
            $this->manufacturerId = $ad['manufacturer_id'];
            $this->description = $ad['description'];
            $this->modelId = $ad['model_id'];
            $this->price = $ad['price'];
            $this->year = $ad['year'];
            $this->typeId = $ad['type_id'];
            $this->userId = $ad['user_id'];
            $this->image = $ad['image'];
            $this->active = (int)$ad['active'];
            $this->slug = $ad['slug'];
            $this->vinCode = $ad['vin_code'];
            $this->date = $ad['date'];
            $this->visitor = $ad['visitor'];
        }
        return $this;
    }
    public function loadBySlug($slug): ?Ad
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)->where('slug', $slug)->getOne();
        if(!empty($rez)){
            $this->load($rez['id']);
            return $this;
        }else{
            return null;
        }
    }

    public static function getAllAds(?int $page = null, ?int $limit = null): array
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

    public static function getAdsForAdmin(?int $page = null, ?int $limit = null): array
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

    public static function getLatest(): array
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

    public static function getPopularAds(int $limit): array
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