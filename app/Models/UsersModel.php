<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "username";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'name', 'email', 'address', 'latitude', 'longitude', 'kelas', 'role', 'profile_picture', 'created_at', 'updated_at', 'link', 'status'];

    public function getjarak()
    {
        $usernow = session()->get('username');
        $latnow = session()->get('latitude');
        $longnow = session()->get('longitude');

        // hyang nareswara
        $query = $this->db->query("SELECT *, 
        ( 6371 * acos
        (
            sin( radians($latnow))  * sin(radians(latitude))
        +
         cos( radians($latnow) ) * cos( radians( latitude ) ) 
        * 
        cos (radians( longitude ) -  radians($longnow) )
        ))
                as jarak_km FROM users
                INNER JOIN mentor_detail ON mentor_detail.username = users.username
                where users.username != '$usernow' AND mentor_detail.status_verified = '1'
                HAVING role = 'pendamping' ORDER BY mentor_detail.username ASC

                ");


        // https://stackoverflow.com/questions/574691/mysql-great-circle-distance-haversine-formula
        // $query = $this->db->query("SELECT *, 
        // ( 6371 * acos
        // ( 
        // cos( radians($latnow) ) * cos( radians( latitude ) ) 
        // * 
        // cos( radians( longitude ) - radians($longnow) )
        //  +
        //  sin( radians($latnow) ) * sin(radians(latitude))
        //  ) )
        //         as jarak_km FROM users
        //         INNER JOIN mentor_detail ON mentor_detail.username = users.username
        //         where users.username != '$usernow' AND mentor_detail.status_verified = '1'
        //         HAVING role = 'pendamping' ORDER BY jarak_km ASC

        //         ");

        // lupa dpt darimana
        // $query = $this->db->query("SELECT *, 
        // (((acos
        // (sin((" . $latnow . "*pi()/180)) * sin((`latitude`*pi()/180))
        //  + 
        //  cos((" . $latnow . "*pi()/180)) * cos((`latitude`*pi()/180))
        //   * cos(((" . $longnow . "- `longitude`)*pi()/180)))) * 180/pi())
        //    * 60 * 1.1515 * 1.609344)
        // as jarak_km FROM users
        // INNER JOIN mentor_detail ON mentor_detail.username = users.username
        // where users.username != '$usernow' AND mentor_detail.status_verified = '1'
        // HAVING role = 'pendamping' ORDER BY jarak_km ASC

        // ");
        return $query->getResult();
    }

    public function getMentorByScore()
    {
        $query = $this->db->query("
        SELECT * FROM users 
        INNER JOIN exam_user_take_exam ON exam_user_take_exam.username = users.username
        WHERE users.username IN (SELECT username FROM exam_user_take_exam) 
        ORDER BY jarak_km DESC
        ");
        return $query->getResult();
    }

    public function getProfile()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM users 
        WHERE users.username = '$usernow'

        ");

        return $query->getResult();
    }
    public function getProfileMentor()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM users 
        INNER JOIN mentor_detail ON mentor_detail.username = users.username
        WHERE users.username = '$usernow'

        ");

        return $query->getResult();
    }

    public function getMentorList()
    {
        $query = $this->db->query("
        SELECT * FROM users 
        INNER JOIN mentor_detail ON mentor_detail.username = users.username 
        
        WHERE role = 'pendamping' 
        ");

        return $query->getResultArray();
    }

    public function getStudentList()
    {
        $query = $this->db->query("
        SELECT * FROM users WHERE role = 'siswa' 
        ");

        return $query->getResultArray();
    }

    public function updateProfilePict($username, $profile_picture)
    {
        $this->db->query("
        UPDATE users SET profile_picture = '$profile_picture'
        WHERE username = '$username'
        ");
    }

    public function getTotalAllMentor()
    {
        $query = $this->db->query("
        SELECT COUNT(username) FROM users WHERE role = 'pendamping' 
        ");
        return $query->getRow();
    }
    public function getTotalAllStudent()
    {
        $query = $this->db->query("
        SELECT COUNT(username) FROM users WHERE role = 'siswa' 
        ");
        return $query->getRow();
    }
}
