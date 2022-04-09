<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel2 extends Model
{
    protected $table = "users";
    protected $primaryKey = "username";
    protected $returnType = "App\Entities\Users";
    protected $useTimestamps = true;
    protected $allowedFields = ['username', 'password', 'name', 'email','address','latitude','longitude','role','created_at','updated_at'];


}