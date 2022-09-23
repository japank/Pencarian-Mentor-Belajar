<?php

namespace App\Models;

use CodeIgniter\Model;

class QuestionModel extends Model
{
    protected $table = "question";
    protected $primaryKey = "question_number";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['question_number', 'text'];

    public function getTotal()
    {
        $query = $this->db->query("SELECT COUNT(question_number) as total FROM question ");
        return $query->getResult();
    }


    public function getQuestion()
    {
        $number = (int) $_GET['n'];

        $query = $this->db->query("SELECT  * FROM question WHERE question_number = '$number'");

        return $query->getResult();
    }
}
