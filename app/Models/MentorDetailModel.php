<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class MentorDetailModel extends Model
{
    protected $table = "mentor_detail";
    protected $primaryKey = "id_mentor_detail";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_mentor_detail', 'username', 'status_verified', 'test_score'];
}
