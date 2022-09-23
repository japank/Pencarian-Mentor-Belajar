<?php

namespace App\Models;

use CodeIgniter\Model;

class ChatModel extends Model
{
    protected $table = "chat";
    protected $primaryKey = "id_chat";
    protected $returnType = "App\Entities\Chat";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_chat', 'id_room', 'username', 'message', 'media', 'is_active', 'created'];

    public function getChatsByRoom($idRoom)
    {
        $chats = $this->db->table($this->table)->where('id_room', $idRoom)->get()->getResult();
        return $chats;
    }
}
