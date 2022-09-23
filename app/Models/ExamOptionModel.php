<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamOptionModel extends Model
{
    protected $table = "exam_option";
    protected $primaryKey = "id_option";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_option', 'question_id', 'exam_id', 'option_title'];

    public function getOption($question_id)
    {

        $query = $this->db->query("
        SELECT * from exam_option
        WHERE question_id = $question_id
        ");

        return $query->getResultArray();
    }
}
