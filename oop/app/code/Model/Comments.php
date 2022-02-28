<?php
namespace Model;
use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;


class Comments extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'comments';

    private $userId;

    private $ip;

    private $message;

    private $date;

    private $adId;

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
    public function setUserId($userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     */
    public function setIp($ip): void
    {
        $this->ip = $ip;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getAdId()
    {
        return $this->adId;
    }

    /**
     * @param mixed $adId
     */
    public function setAdId($adId): void
    {
        $this->adId = $adId;
    }



// $ip = $_SERVER['REMOTE_ADDR'];


    public function assignData()
    {
        $this->data = [
            'user_id' => $this->userId,
            'ip' => $this->ip,
            'ad_id' => $this->adId,
            'message' => $this->message,
            'date' => $this->date
        ];

    }

    public function load($id)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', $id)->getOne();
        $this->id = $data['id'];
        $this->userId = $data['user_id'];
        $this->ip = $data['ip'];
        $this->adId = $data['ad_id'];
        $this->message = $data['message'];
        $this->date = $data['date'];
        return $this;
    }

    public static function getAdComments($adId)
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('ad_id', $adId)->get();
        $comments = [];
        foreach($data as $element){
            $comment = new Comments();
            $comment->load($element['id']);
            $comments[] = $comment;
        }
        return $comments;
    }






}