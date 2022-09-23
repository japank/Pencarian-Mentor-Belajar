<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Chat extends BaseController
{
    public function __construct()
    {
        $this->session = session();
    }

    public function index()
    {


        $id = session()->get('username');
        $userModel = new \App\Models\UsersModel2();
        $user = $userModel->find($id);
        $roomModel = new \App\Models\RoomModel();

        $allUsers = $userModel->where('username !=', $id)->findAll();
        $recentChat = $roomModel->getRecentMessage();

        return view('chat', [
            'user' => $user,
            'username' => $id,
            'allUsers' => $allUsers,
            'recentChat' => $recentChat,
        ]);
    }

    public function getRoomByUser()
    {
        $id = session()->get('username');
        if ($this->request->isAJAX()) {
            $idCurrentUser = $id;
            $idReceiver = $this->request->getGet('contactId');

            $roomModel = new \App\Models\RoomModel();
            $room = $roomModel->getRoomByUser([$idCurrentUser, $idReceiver]);

            return $this->response->setJSON($room);
        }
    }

    public function sendMessage()
    {
        if ($this->request->isAJAX()) {
            $message = $this->request->getPost('message');
            $id_room = $this->request->getPost('id_room');
            $id_user = session()->get('username');

            $modelChat = new \App\Models\ChatModel();
            $chat = new \App\Entities\Chat();
            $created = date("Y-m-d H:i:s");

            $chat->id_room = $id_room;
            $chat->username = session()->get('username');
            $chat->message = $message;
            $chat->media = NULL;
            $chat->is_active = 1;
            $chat->created = $created;

            $modelChat->save($chat);

            $chatMessage = [
                'created' => $created,
                'message' => $message,
            ];

            return $this->response->setJSON($chatMessage);
        }
    }

    public function getChatsByRoomId()
    {
        if ($this->request->isAJAX()) {
            $id_room = $this->request->getPost('roomId');

            $chatModel = new \App\Models\ChatModel();
            $chats = $chatModel->getChatsByRoom($id_room);

            return $this->response->setJSON($chats);
        }
    }
}
