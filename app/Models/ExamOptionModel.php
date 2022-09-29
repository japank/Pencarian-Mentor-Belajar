<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamOptionModel extends Model
{
    protected $table = "exam_option";
    protected $primaryKey = "id_option";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_option', 'question_id', 'exam_id', 'option_number', 'option_title'];

    public function getOption($question_id)
    {

        $query = $this->db->query("
        SELECT * from exam_option
        WHERE question_id = $question_id
        ");

        return $query->getResultArray();
    }
    public function getAllOption()
    {

        $query = $this->db->query("
        SELECT * from exam_option

        ");

        return $query->getResultArray();
    }

    public function addOption($exam_id, $last_insert_id, $option1, $option2, $option3, $option4)
    {
        $this->db->query("
        INSERT INTO exam_option
            (question_id, exam_id,option_number, option_title)
        VALUES
            ('$last_insert_id','$exam_id','1','$option1'),
            ('$last_insert_id','$exam_id','2','$option2'),
            ('$last_insert_id','$exam_id','3','$option3'),
            ('$last_insert_id','$exam_id','4','$option4');
        ");
    }
}
