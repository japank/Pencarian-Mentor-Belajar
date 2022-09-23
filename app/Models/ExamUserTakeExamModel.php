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
    protected $allowedFields = ['id_exam_user_take_exam', 'username', 'exam_id', 'status'];
}
