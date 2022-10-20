<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class ExamUserTakeExamModel extends Model
{
    protected $table = "exam_user_take_exam";
    protected $primaryKey = "id_exam_user_take_exam";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_exam_user_take_exam', 'username', 'exam_id', 'status', 'score'];

    public function getStatus()
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM exam_user_take_exam WHERE username = '$usernow'
        ");

        $result =  $query->getResultArray();
        foreach ($result as $row) {
            return $row['status'];
        }
    }

    public function updateStatus($username, $exam_id, $score)
    {

        $query = $this->db->query("
        UPDATE exam_user_take_exam SET status = 'complete', score = $score
        WHERE username = '$username' AND exam_id = $exam_id
        ");
    }

    public function getMentorListScore()
    {
        $query = $this->db->query("
        SELECT * FROM exam_user_take_exam
        INNER JOIN exam_detail ON exam_detail.exam_id = exam_user_take_exam.exam_id");
        return $query->getResultArray();
    }
}
