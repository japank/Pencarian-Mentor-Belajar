<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $primaryKey = "username";
    protected $returnType = "object";
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'name', 'email', 'address', 'latitude', 'longitude', 'kelas', 'role', 'created_at', 'updated_at'];

    public function getjarak()
    {
        $usernow = session()->get('username');
        $latnow = session()->get('latitude');
        $longnow = session()->get('longitude');


        $query = $this->db->query("SELECT *, 
        (((acos(sin((" . $latnow . "*pi()/180)) * sin((`latitude`*pi()/180)) + cos((" . $latnow . "*pi()/180)) * cos((`latitude`*pi()/180)) * cos(((" . $longnow . "- `longitude`)*pi()/180)))) * 180/pi()) * 60 * 1.1515 * 1.609344)
        as jarak_km FROM users where username != '$usernow' HAVING role = 'pendamping' ORDER BY jarak_km ASC

        ");
        return $query->getResult();
    }

    public function getProfile()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM users WHERE username = '$usernow'
        ");

        return $query->getResult();
    }
}
