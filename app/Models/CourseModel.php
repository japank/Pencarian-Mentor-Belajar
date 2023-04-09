<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = "course";
    protected $primaryKey = "id_course";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_course', 'name_course'];


    public function getCourse()
    {
        $query = $this->db->query("
        SELECT * FROM course
        ");

        return $query->getResultArray();
    }
}
