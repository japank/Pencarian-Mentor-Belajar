<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestMentorModel extends Model
{
    protected $table = "request_mentor";
    protected $primaryKey = "id_request_mentor";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_request_mentor', 'username_siswa', 'username_mentor', 'date_started', 'topic', 'description', 'status_request'];

    public function getRequestMentoring()
    {
        $usernow = session()->get('username');
        return $this->db->table('request_mentor')
            ->join('users', 'users.username=request_mentor.username_mentor')
            ->orderBy('request_mentor.id_request_mentor', 'DESC')
            ->getWhere(['username_siswa' => $usernow])
            ->getResultArray();
    }

    public function getRequestMentoringByMentor()
    {
        $usernow = session()->get('username');
        return $this->db->table('request_mentor')
            ->join('users', 'users.username=request_mentor.username_siswa')
            ->orderBy('id_request_mentor', 'DESC')
            ->getWhere(['username_mentor' => $usernow])
            ->getResultArray();
    }

    public function getSiswaMentored()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM users WHERE username IN 
        (SELECT username_siswa FROM request_mentor WHERE username_mentor = '$usernow')
        ");

        return $query->getResultArray();
    }

    public function getMentor()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM users WHERE username IN 
        (SELECT username_mentor FROM request_mentor WHERE username_siswa = '$usernow')
        ");

        return $query->getResult();
    }

    public function getMentorFromStudent($username)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM users WHERE username IN 
        (SELECT username_mentor FROM request_mentor WHERE username_siswa = '$username')
        ");

        return $query->getResultArray();
    }
    public function getMentoredStudent($username)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM users WHERE username IN 
        (SELECT username_siswa FROM request_mentor WHERE username_mentor = '$username')
        ");

        return $query->getResultArray();
    }
}
