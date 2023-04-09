<?php

namespace App\Models;

use CodeIgniter\Model;

class RequestMentorModel extends Model
{
    protected $table = "request_mentor";
    protected $primaryKey = "id_request_mentor";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_request_mentor', 'username_siswa', 'username_mentor', 'date_started', 'time_mentoring', 'topic', 'description', 'status_request', 'status_mentoring'];

    public function getRequestMentoring()
    {
        $usernow = session()->get('username');
        $latnow = session()->get('latitude');
        $longnow = session()->get('longitude');


        $query = $this->db->query("SELECT *, 
        ( 6371 * acos
            (
                sin(radians($latnow)) * sin(radians(latitude))
                +
                cos(radians($latnow)) * cos(radians(latitude)) 
                * 
                cos(radians(longitude) -  radians($longnow))
            )
        )
        
            AS jarak_km FROM users
            INNER JOIN request_mentor ON request_mentor.username_mentor = users.username
            where request_mentor.username_siswa = '$usernow' 
            ORDER BY request_mentor.id_request_mentor DESC
                ");


        return $query->getResultArray();
    }

    public function getAccRequestMentoring()
    {
        $usernow = session()->get('username');
        $latnow = session()->get('latitude');
        $longnow = session()->get('longitude');


        $query = $this->db->query("SELECT *, 
        ( 6371 * acos
            (
                sin(radians($latnow)) * sin(radians(latitude))
                +
                cos(radians($latnow)) * cos(radians(latitude)) 
                * 
                cos(radians(longitude) -  radians($longnow))
            )
        )
        
            AS jarak_km FROM users
            INNER JOIN request_mentor ON request_mentor.username_mentor = users.username
            where request_mentor.username_siswa = '$usernow' AND request_mentor.status_request = '1'
            ORDER BY request_mentor.id_request_mentor DESC
                ");


        return $query->getResultArray();
    }

    public function getRequestMentoringByMentor()
    {

        $usernow = session()->get('username');
        $latnow = session()->get('latitude');
        $longnow = session()->get('longitude');


        $query = $this->db->query("SELECT *, 
        ( 6371 * acos
            (
                sin(radians($latnow)) * sin(radians(latitude))
                +
                cos(radians($latnow)) * cos(radians(latitude)) 
                * 
                cos(radians(longitude) -  radians($longnow))
            )
        )
        
            AS jarak_km FROM users
            INNER JOIN request_mentor ON request_mentor.username_siswa = users.username
            where request_mentor.username_mentor = '$usernow' AND request_mentor.status_request = '2'
            ORDER BY request_mentor.id_request_mentor DESC
                ");


        return $query->getResultArray();
    }

    public function getRequestHistoryByMentor()
    {

        $usernow = session()->get('username');
        $latnow = session()->get('latitude');
        $longnow = session()->get('longitude');


        $query = $this->db->query("SELECT *, 
        ( 6371 * acos
            (
                sin(radians($latnow)) * sin(radians(latitude))
                +
                cos(radians($latnow)) * cos(radians(latitude)) 
                * 
                cos(radians(longitude) -  radians($longnow))
            )
        )
        
            AS jarak_km FROM users
            INNER JOIN request_mentor ON request_mentor.username_siswa = users.username
            where request_mentor.username_mentor = '$usernow' AND request_mentor.status_request != '2'
            ORDER BY request_mentor.id_request_mentor DESC
                ");


        return $query->getResultArray();
    }
    public function getRequestAcceptedByMentor()
    {

        $usernow = session()->get('username');
        $latnow = session()->get('latitude');
        $longnow = session()->get('longitude');


        $query = $this->db->query("SELECT *, 
        ( 6371 * acos
            (
                sin(radians($latnow)) * sin(radians(latitude))
                +
                cos(radians($latnow)) * cos(radians(latitude)) 
                * 
                cos(radians(longitude) -  radians($longnow))
            )
        )
        
            AS jarak_km FROM users
            INNER JOIN request_mentor ON request_mentor.username_siswa = users.username
            where request_mentor.username_mentor = '$usernow' AND request_mentor.status_request = '1'
            ORDER BY request_mentor.id_request_mentor DESC
                ");


        return $query->getResultArray();
    }

    public function getTotalRequest()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT COUNT(username_siswa) FROM request_mentor WHERE username_mentor = '$usernow' AND status_request = 2
        ");


        return $query->getRow();
    }
    public function getTotalRequestDecline()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT COUNT(username_siswa) FROM request_mentor WHERE username_mentor = '$usernow' AND status_request = 0
        ");


        return $query->getRow();
    }
    public function getTotalStudentMentored()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT COUNT(username_siswa) FROM request_mentor WHERE username_mentor = '$usernow' AND status_request = 1
        ");


        return $query->getRow();
    }
    public function getTotalRequestByStudent()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT COUNT(username_mentor) FROM request_mentor WHERE username_siswa = '$usernow' AND status_request = 2
        ");


        return $query->getRow();
    }
    public function getTotalMentor()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT COUNT(username_mentor) FROM request_mentor WHERE username_siswa = '$usernow' AND status_request = 1
        ");


        return $query->getRow();
    }

    public function getMentoringHistory($username)
    {

        $query = $this->db->query("SELECT * FROM users
            INNER JOIN request_mentor ON request_mentor.username_siswa = users.username
            where request_mentor.username_mentor = '$username' AND request_mentor.status_request = '1'
            ORDER BY request_mentor.id_request_mentor DESC
                ");


        return $query->getResultArray();
    }
    public function getMentoringHistoryFromSiswa($username)
    {

        $query = $this->db->query("SELECT * FROM users
            INNER JOIN request_mentor ON request_mentor.username_mentor = users.username
            where request_mentor.username_siswa = '$username' AND request_mentor.status_request = '1'
            ORDER BY request_mentor.id_request_mentor DESC
                ");


        return $query->getResultArray();
    }
}
