<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamQuestionAnswerByUserModel extends Model
{
    protected $table = "exam_question_answer_by_user";
    protected $primaryKey = "id_question_answer_by_user";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_question_aswer_by_user', 'username', 'exam_id', 'question_id', 'user_answer_option', 'marks'];

    public function updateQuestionAnswer($username, $exam_id, $question_id, $user_answer_option, $marks)
    {

        $query = $this->db->query("
        UPDATE exam_question_answer_by_user SET user_answer_option = $user_answer_option, marks = $marks
        WHERE username = '$username' AND exam_id = $exam_id AND question_id = $question_id
        ");
    }

    public function getUserAnswer($username, $exam_id, $question_id)
    {
        $query = $this->db->query("
        SELECT * FROM exam_question_answer_by_user 
        WHERE username = '$username' AND exam_id = $exam_id AND question_id = $question_id
        ");

        return $query->getResult();
    }
}
