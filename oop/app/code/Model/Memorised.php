<?php

namespace Model;


use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class Memorised extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'memorised';

    private int $userId;

    private int $adId;

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getAdId(): int
    {
        return $this->adId;
    }

    /**
     * @param int $adId
     */
    public function setAdId(int $adId): void
    {
        $this->adId = $adId;
    }

    public function assignData(): void
    {
        $this->data =[
            'user_id' => $this->userId,
            'ad_id' => $this->adId
        ];

    }

    public function load(int $id): object
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('id', $id)
            ->getOne();
        if(!empty($data)) {
            $this->id = (int)$data['id'];
            $this->userId = (int)$data['user_id'];
            $this->adId = (int)$data['ad_id'];
        }
        return $this;
    }
    public function loadByUserAndAd($userId, $adId)
    {

        $rating = new DBHelper();
        $data = $rating->select()->from(self::TABLE)
            ->where('user_id', (string)$userId)
            ->andWhere('ad_id', (string)$adId)->getOne();
        if (!empty($data)) {
            $this->load($data['id']);
            return $this;
        }
        return null;
    }

    public static function getMemorisedAds($userId): array
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)
            ->where('user_id', $userId)
            ->get();
        $ads = [];
        foreach($data as $element) {
            $memorisedAds = new Ad();
            $memorisedAds->load((int)$element['ad_id']);
            $ads[] = $memorisedAds;
            }
        return $ads;
    }
    public static function isItFavouriteAd($userId, $adId)
    {
        $db = new DBHelper();
        $rez = $db->select()->from(self::TABLE)
            ->where('user_id', $userId)
            ->andWhere('ad_id', $adId)
            ->getOne();
        return isset($rez) ? $rez : false;

        }

}