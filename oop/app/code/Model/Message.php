<?php

namespace Model;


use Core\AbstractModel;
use Core\Interfaces\ModelInterface;
use Helper\DBHelper;

class Message extends AbstractModel implements ModelInterface
{
    protected const TABLE = 'messages';

    private int $senderId;

    private int $receiverId;

    private string $message;

    private string $date;

    private int $status;

    private int $active;


    public function getSenderId(): string
    {
        return $this->senderId;
    }

    public function setSenderId(int $senderId): void
    {
        $this->senderId = $senderId;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function setReceiverId(int $receiverId): void
    {
        $this->receiverId = $receiverId;
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

    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getActive(): int
    {
        return $this->active;
    }

    public function setActive(int $active): void
    {
        $this->active = $active;
    }

    public function assignData(): void
    {
        $this->data =[
            'sender_id' => $this->senderId,
            'receiver_id' => $this->receiverId,
            'message' => $this->message,
            'date' => $this->date,
            'status' => $this->status,
            'active' => $this->active
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
            $this->senderId = (int)$data['sender_id'];
            $this->receiverId = (int)$data['receiver_id'];
            $this->message = (string)$data['message'];
            $this->date = (string)$data['date'];
            $this->status = (int)$data['status'];
            $this->active = (int)$data['active'];
        }
        return $this;
    }

    public static function getUnreadMessageCount()
    {
        $db = new DBHelper();
        $rez = $db->select('COUNT(*)')
            ->from(self::TABLE)
            ->where('receiver_id', $_SESSION['user_id'])
            ->andWhere('status', 0)
            ->get();
        return $rez[0][0];
    }

    public static function getUserRelatedMessages()
    {
        $db = new DBHelper();
        $userId =$_SESSION['user_id'];
        $data = $db->select()
            ->from(self::TABLE)
            ->where('sender_id', $userId)
            ->orWhere('receiver_id', $userId)
            ->get();
        $messages = [];
        foreach($data as $element){
            $message = new Message();
            $message->load($element['id']);
            $messages[] = $message;
        }
        return $messages;
    }

    public static function getUserMessagesWithFriend($friendId)
    {
        $db = new DBHelper();
        $userId =$_SESSION['user_id'];
        $data = $db->select()
            ->from(self::TABLE)
            ->where('sender_id', $userId)
            ->andWhere('receiver_id', $friendId)
            ->orWhere('receiver_id', $userId)
            ->andWhere('sender_id', $friendId)
            ->get();
        $messages = [];
        foreach($data as $element){
            $message = new Message();
            $message->load($element['id']);
            $messages[] = $message;
        }
        return $messages;
    }
    public static function makeSeen($senderId, $receiverId)
    {
        $db = new DBHelper();
        $db->update(self::TABLE, ['status' => 1])
            ->where('sender_id', $senderId)
            ->andWhere('receiver_id', $receiverId)
            ->andWhere('status', 0)
            ->exec();

    }

}