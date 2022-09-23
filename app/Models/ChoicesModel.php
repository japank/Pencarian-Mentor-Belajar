<?php

namespace App\Models;

use CodeIgniter\Model;

class ChoicesModel extends Model
{
    protected $table = "choices";
    protected $primaryKey = "id";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id' . 'question_number', 'is_correct', 'text'];


    public function getChoices()
    {
        $number = (int) $_GET['n'];

        $query = $this->db->query("SELECT  * FROM choices WHERE question_number = '$number'");

        return $query->getResult();
    }

    public function getCorrectChoices()
    {
        $number = (int) $_GET['n'];

        $query = $this->db->query("SELECT  * FROM `choices` WHERE question_number = '$number' AND is_correct = 1");

        return $query->getResult();
    }
}
