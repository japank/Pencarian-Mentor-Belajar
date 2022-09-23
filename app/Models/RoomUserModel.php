<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomUserModel extends Model
{
    protected $table = "room_user";
    protected $primaryKey = "id_room_and_user";
    protected $returnType = "App\Entities\RoomUser";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_room_and_user', 'id_room', 'username'];
}
