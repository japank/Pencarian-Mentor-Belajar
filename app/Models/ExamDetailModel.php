<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamDetailModel extends Model
{
    protected $table = "exam_detail";
    protected $primaryKey = "exam_id";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['exam_id', 'name', 'level', 'marks_per_right_answer', 'marks_per_wrong_answer', 'pass_score', 'time'];


    public function getQuestionRightAnswerMark($exam_id)
    {
        $query = $this->db->query("
        SELECT marks_per_right_answer FROM exam_detail WHERE exam_id = $exam_id
        ");

        $result = $query->getResultArray();

        foreach ($result as $row) {
            return $row['marks_per_right_answer'];
        }
    }

    public function getQuestionWrongAnswerMark($exam_id)
    {
        $query = $this->db->query("
        SELECT marks_per_wrong_answer FROM exam_detail WHERE exam_id = $exam_id
        ");


        $result = $query->getResultArray();

        foreach ($result as $row) {
            return $row['marks_per_wrong_answer'];
        }
    }

    public function getExamList()
    {
        $query = $this->db->query("
        SELECT * FROM exam_detail ORDER BY level ASC
        ");

        return $query->getResultArray();
    }

    public function getExamTaked()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM exam_detail INNER JOIN exam_user_take_exam
        ON exam_user_take_exam.exam_id = exam_detail.exam_id
        WHERE exam_user_take_exam.username = '$usernow'
        ");
        return $query->getResultArray();
    }

    public function getExamDetail($exam_id)
    {
        $query = $this->db->query("
        SELECT * FROM exam_detail WHERE exam_id = $exam_id
        ");
        return $query->getResultArray();
    }

    public function getExamTitle($exam_id)
    {
        $query = $this->db->query("
        SELECT name FROM exam_detail WHERE exam_id = $exam_id
        ");
        return $query->getRow();
    }
}
