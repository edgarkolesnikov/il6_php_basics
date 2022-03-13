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

    public function load($ratings): object
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('user_id', $ratings)
            ->get();

        return $data;
    }

    public static function checkIfUserVoted($userId, $adId)
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('user_id', $userId)
            ->andWhere('ad_id', $adId)
            ->getOne();
        return isset($data['id']) ? $data['id'] : null;
    }

    public static function countAverageRating($id)
    {
        $db = new DBHelper();
        $data = $db -> select('AVG(rating)')-> from(self::TABLE)->where('ad_id', $id)->getOne();
        return $data;
    }

}