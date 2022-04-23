<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestMentorModel extends Model
{
    protected $table = "request_mentor";
    protected $primaryKey = "id_request_mentor";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_request_mentor','username_siswa','username_mentor','date_started','topic','status_request'];

    public function getRequestMentoring(){
        $usernow = session()->get('username');
        return $this->db->table('request_mentor')
        ->join('users','users.username=request_mentor.username_mentor')
        ->getWhere(['username_siswa' => $usernow])->getResultArray();
    }

    public function getRequestMentoringByMentor(){
        $usernow = session()->get('username');
        return $this->db->table('request_mentor')
        ->join('users','users.username=request_mentor.username_siswa')
        ->getWhere(['username_mentor' => $usernow])->getResultArray();
    }

}