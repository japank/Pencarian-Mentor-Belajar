<?php

namespace App\Models;

use CodeIgniter\Model;

class RoomModel extends Model
{
    protected $table = "room";
    protected $primaryKey = "id_room";
    protected $returnType = "App\Entities\Room";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_room', 'name', 'is_group'];

    function getRoomByUser($userArray, $is_group=0){
        $userModel = new \App\Models\UsersModel2();
        $roomUserModel = new \App\Models\RoomUserModel();

        $roomUserCheck = $roomUserModel->select('room.id_room AS roomId')
        ->join('room', 'room.id_room = room_user.id_room', 'right')
        ->whereIn('room_user.username', $userArray)
        ->where('room.is_group', $is_group)
        ->groupBy('room.id_room')
        ->having('COUNT(room.id_room)',2)
        ->first();

        if(empty($roomUserCheck)){
            $roomData = [
                'name' => '',
                'is_group' => 0,
            
            ];

            $this->db->transStart();

            $room = $this->db->table($this->table)->insert($roomData);

            $idRoom = $this->db->insertID();

            $userData = [

            ];

            foreach($userArray as $u){
                $temp = [
                    'username' => $u,
                    'id_room' => $idRoom, 
                ];
                array_push($userData, $temp);
            }

            $roomUserBuilder = $roomUserModel->builder();
            $roomUser = $roomUserBuilder->insertBatch($userData);

            $this->db->transComplete(); 

            return $this->db->table($this->table)->where('id_room, $idRoom')->get()->getRow();
        }

        $room = $this->db->table($this->table)->where('id_room', $roomUserCheck->roomId)->get()->getRow();

        return $room;
    }

    function getRecentMessage(){
        $userModel = new \App\Models\UsersModel2();
        $roomUserModel = new \App\Models\RoomUserModel();
        $usernow = session()->get('username');

        $query = $this->db->query("SELECT * FROM users WHERE username IN 
        (SELECT username FROM room_user where id_room IN 
        (SELECT id_room FROM room_user where username = 
        (SELECT username FROM users where username='$usernow'))
        && username != '$usernow' && id_room IN (SELECT id_room FROM chat))
        ");

        return $query->getResult();
    }


}