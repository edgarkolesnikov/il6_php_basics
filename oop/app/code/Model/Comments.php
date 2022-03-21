<?php
namespace Model;
use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;


class Comments extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'comments';

    private int $userId;

    private string $ip;

    private string $message;

    private string $date;

    private int $adId;


    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }


    public function getIp(): string
    {
        return $this->ip;
    }


    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }


    public function getDate(): string
    {
        return $this->date;
    }

    public function setDate($date): void
    {
        $this->date = $date;
    }

    public function getAdId(): int
    {
        return $this->adId;
    }

    public function setAdId($adId): void
    {
        $this->adId = $adId;
    }



// $ip = $_SERVER['REMOTE_ADDR'];


    public function assignData(): void
    {
        $this->data = [
            'user_id' => $this->userId,
            'ip' => $this->ip,
            'ad_id' => $this->adId,
            'message' => $this->message,
            'date' => $this->date
        ];

    }

    public function load(int $id): Comments
    {
        $db = new DBHelper();
        $data = $db->select()->from(self::TABLE)->where('id', (string)$id)->getOne();
        $this->id = $data['id'];
        $this->userId = $data['user_id'];
        $this->ip = (string)$data['ip'];
        $this->adId = $data['ad_id'];
        $this->message = $data['message'];
        $this->date = $data['date'];
        return $this;
    }

    public static function getAdComments(int $adId): array
    {
        $db = new DBHelper();
        $data = $db->select()
            ->from(self::TABLE)
            ->where('ad_id', $adId)
            ->orderBy('id', 'DESC')
            ->get();
        $comments = [];
        foreach($data as $element){
            $comment = new Comments();
            $comment->load($element['id']);
            $comments[] = $comment;
        }
        return $comments;
    }






}