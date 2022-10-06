<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
    protected $table = "logbook";
    protected $primaryKey = "id_logbook";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_logbook', 'username_siswa', 'username_mentor', 'date_mentoring', 'topic', 'topic_description', 'description'];

    public function getLogbookSiswaByMentor($username)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM logbook WHERE username_siswa = '$username' && username_mentor = '$usernow';
        ");

        return $query->getResult();
        // return $this->db->table('logbook')
        // ->getWhere(['username_siswa' => $username] && ['username_mentor' => $usernow])
        // ->getResultArray();
    }

    public function getLogbookSiswa($username)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM logbook WHERE username_siswa = '$usernow' && username_mentor = '$username';
        ");

        if ($usernow = $username) {
            return $query->getResult();
        }
        // return $this->db->table('logbook')
        // ->getWhere(['username_siswa' => $username] && ['username_mentor' => $usernow])
        // ->getResultArray();
    }
    public function getLogbookSiswaByAdmin($username_siswa, $username_mentor)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM logbook WHERE username_siswa = '$username_siswa' && username_mentor = '$username_mentor';
        ");

        return $query->getResultArray();
    }

    public function getAllLogbookStudent($username_siswa)
    {
        $query = $this->db->query("
        SELECT * FROM logbook WHERE username_siswa = '$username_siswa';
        ");

        return $query->getResultArray();
    }
    public function getAllLogbookMentor($username_mentor)
    {
        $query = $this->db->query("
        SELECT * FROM logbook WHERE username_mentor = '$username_mentor';
        ");

        return $query->getResultArray();
    }


    // public function getRequestMentoringByMentor(){
    //     $usernow = session()->get('username');
    //     return $this->db->table('request_mentor')
    //     ->join('users','users.username=request_mentor.username_siswa')
    //     ->getWhere(['username_mentor' => $usernow])->getResultArray();
    // }

    // public function getSiswaMentored(){
    //     $usernow = session()->get('username');
    //     $query = $this->db->query("
    //     SELECT * FROM users WHERE username IN 
    //     (SELECT username_siswa FROM request_mentor WHERE username_mentor = '$usernow')
    //     ");

    //     return $query->getResult();

    // }

}
