<?php

declare(strict_types=1);

namespace Controller;

use Core\AbstractControler;
use Core\Interfaces\ControllerInterface;
use Model\Message as MessageModel;
use Helper\Url;
use Model\User;

class Message extends AbstractControler implements ControllerInterface
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->isUserLoged()){
            Url::redirect('user/login');
        }
    }

    public function index(): void
    {
        $messages = MessageModel::getUserRelatedMessages();
        $chats = [];
        foreach($messages as $message){
//            if($message->getSenderId() > $message->getReceiverId()){
//                $key = $message->getReceiverId().'-'.$message->getSenderId();
//            }else{
//                $key = $message->getSenderId().'-'.$message->getReceiverId();
//            }
            //sitas if virsuje padeda issigrupuoti pagal id pvz [1-2]   [1-7]
            // tokiu atveju apacioje rasytume $chats[$key]['messsage'] = $message; ir pan.
            $chatFriendId =$message->getSenderId() == $_SESSION['user_id'] ? $message->getReceiverId() : $message->getSenderId();
            $chatFriend = new User();
            $chatFriend->load((int)$chatFriendId);
            $chats[$chatFriendId]['message'] = $message;
            $chats[$chatFriendId]['chat_friend'] = $chatFriend;
        }
        usort($chats, function ($item1, $item2) {
            return $item2['message']->getId() <=> $item1['message']->getId();
        });
        $this->data['chat'] = $chats;
        $this->render('messages/all');
    }

    public function chat($chatFriendId)
    {
        $this->data['messages'] = MessageModel::getUserMessagesWithFriend($chatFriendId);
        MessageModel::makeSeen($chatFriendId, $_SESSION['user_id']);
        $this->data['receiver_id'] = $chatFriendId;
        $this->render('messages/chat');
    }

    public function send()
    {
        $message = new MessageModel();
        $message->setMessage($_POST['message']);
        $message->setReceiverId((int)$_POST['receiver_id']);
        $message->setSenderId($_SESSION['user_id']);
        $message->setStatus(0);
        $message->setActive(1);
        $message->setDate(date('Y-m-d h:i:s'));
        $message->save();
        Url::redirect('message/chat/' . $_POST['receiver_id']);
    }

}