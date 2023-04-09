<?php

namespace App\Models;

use CodeIgniter\Model;

class LogbookModel extends Model
{
    protected $table = "logbook";
    protected $primaryKey = "id_logbook";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_logbook', 'id_request_mentor', 'date_mentoring', 'mentoring_description', 'activity_photo'];

    public function getLogbook($id_request)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM logbook 
        INNER JOIN request_mentor ON request_mentor.id_request_mentor = logbook.id_request_mentor
        WHERE logbook.id_request_mentor = '$id_request'
        ");

        return $query->getResult();
        // return $this->db->table('logbook')
        // ->getWhere(['username_siswa' => $username] && ['username_mentor' => $usernow])
        // ->getResultArray();
    }

    public function getLogbookSiswa($id_request)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM logbook WHERE id_request_mentor = '$id_request';
        ");
        return $query->getResult();
        // if ($usernow != $username) {
        //     return $query->getResult();
        // }
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
    public function getTotalBimbingan()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT COUNT(id_logbook) FROM logbook 
        ");


        return $query->getRow();
    }
    public function getTotalBimbinganByMentor()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT COUNT(id_logbook) FROM logbook 
        ");


        return $query->getRow();
    }
}
