<?php

namespace App\Models;

use CodeIgniter\Model;

class ExamQuestionModel extends Model
{
    protected $table = "exam_question";
    protected $primaryKey = "question_id";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['question_id', 'exam_id', 'question_title', 'answer_option'];

    public function getQuestion($exam_id)
    {

        $query = $this->db->query("
        SELECT * from exam_question 
        WHERE exam_id = $exam_id
        ORDER BY question_id ASC
        LIMIT 1
        ");

        return $query->getResultArray();
    }

    public function getQuestion2($question_id)
    {

        $query = $this->db->query("
        SELECT * from exam_question 
        WHERE question_id = $question_id
        ");

        return $query->getResultArray();
    }

    public function getIdPrevQuestion($question_id, $exam_id)
    {
        $query = $this->db->query("
        SELECT question_id FROM exam_question WHERE question_id < $question_id
        AND exam_id = $exam_id
        ORDER BY question_id DESC
        LIMIT 1
        ");
        return $query->getResultArray();
    }
    public function getIdNextQuestion($question_id, $exam_id)
    {
        $query = $this->db->query("
        SELECT question_id FROM exam_question WHERE question_id > $question_id
        AND exam_id = $exam_id
        ORDER BY question_id ASC
        LIMIT 1
        ");
        return $query->getResultArray();
    }

    public function fetchAllQuestionId($exam_id)
    {
        $query = $this->db->query("
        SELECT question_id FROM exam_question WHERE exam_id = $exam_id
        ORDER BY question_id ASC
        ");

        return $query->getResultArray();
    }
    public function getQuestionAnswerOption($question_id)
    {
        $query = $this->db->query("
        SELECT answer_option FROM exam_question WHERE question_id = $question_id
        ");

        $result = $query->getResultArray();

        foreach ($result as $row) {
            return $row['answer_option'];
        }
    }

    public function getExamResultDetail($exam_id)
    {
        $usernow = session()->get('username');
        $query = $this->db->query("
        SELECT * FROM exam_question 
        INNER JOIN exam_question_answer_by_user ON exam_question_answer_by_user.question_id = exam_question.question_id
        WHERE exam_question.exam_id = '$exam_id' AND exam_question_answer_by_user.username = '$usernow'
        ");

        return $query->getResultArray();
    }
    public function getQuestion3($exam_id)
    {

        $query = $this->db->query("
        SELECT * from exam_question 
        WHERE exam_id = $exam_id
        ");

        return $query->getResultArray();
    }
}
