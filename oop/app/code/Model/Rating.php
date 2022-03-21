<?php

namespace Model;


use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class Rating extends AbstractModel  implements ModelInterface
{
    protected const TABLE = 'ratings';

    private int $userId;

    private int $adId;

    private int $rating;

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

    /**
     * @return int
     */
    public function getRating(): int
    {
        return $this->rating;
    }

    /**
     * @param int $rating
     */
    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }


    public function assignData(): void
    {
        $this->data = [
            'user_id' => $this->userId,
            'ad_id' => $this->adId,
            'rating' => $this->rating
        ];
    }

    public function load(int $id): ?object
    {
        $db = new DBHelper();
        $rez = $db->select()
            ->from(self::TABLE)
            ->where('id', $id)
            ->getOne();
        if (!empty($rez)) {
            $this->id = $rez['id'];
            $this->userId = $rez['user_id'];
            $this->adId = $rez['ad_id'];
            $this->rating = $rez['rating'];
            return $this;
        }
        return null;
    }

    public function loadByUserAndAd(int $userId, int $adId): ?object
    {
        $db = new DBHelper();
        $rez = $db->select()
            ->from(self::TABLE)
            ->where('user_id', $userId)
            ->andWhere('ad_id', $adId)
            ->getOne();
        if(!empty($rez)){
            $this->load($rez['id']);
            return $this;
        }
        return null;
    }

//    public static function checkIfUserVoted($userId, $adId)
//    {
//        $db = new DBHelper();
//        $data = $db->select()
//            ->from(self::TABLE)
//            ->where('user_id', $userId)
//            ->andWhere('ad_id', $adId)
//            ->getOne();
//        return isset($data['id']) ? $data['id'] : null;
//    }

    public function getUser()
    {
        $user = new User();
        $user-> load($this->userId);
        return $user;
    }

    public function getAd()
    {
        $ad = new User();
        $ad-> load($this->adId);
        return $ad;
    }

    public static function getRatingsByAd($adId)
    {
        $db = new DBHelper();
        return $db->select()->from(self::TABLE)->where('ad_id', $adId)->get();
    }

    public static function getRatingsByUser()
    {

    }





//    public static function countAverageRating($adId)
//    {
//        $db = new DBHelper();
//        $data = $db -> select('AVG(rating)')-> from(self::TABLE)->where('ad_id', $adId)->getOne();
//        return $data;
//    }

}