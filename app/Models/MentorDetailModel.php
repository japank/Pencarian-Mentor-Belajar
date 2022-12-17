<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use CodeIgniter\Model;

class MentorDetailModel extends Model
{
    protected $table = "mentor_detail";
    protected $primaryKey = "id_mentor_detail";
    protected $returnType = "object";
    protected $useTimestamps = false;
    protected $allowedFields = ['id_mentor_detail', 'username', 'status_verified', 'level_mentor', 'identity_file'];

    public function updateFile($username, $identity_file)
    {
        $this->db->query("
        UPDATE mentor_detail SET identity_file = '$identity_file'
        WHERE username = '$username'
        ");
    }
    public function updateLevel($username, $level)
    {
        $this->db->query("
        UPDATE mentor_detail SET level_mentor = '$level'
        WHERE username = '$username'
        ");
    }
    public function updateStatusVerified($username, $status)
    {
        $this->db->query("
        UPDATE mentor_detail SET status_verified = '$status'
        WHERE username = '$username'
        ");
    }

    public function getMentorDetail($username)
    {
        $query = $this->db->query("
        SELECT * FROM mentor_detail WHERE username = '$username'
        ");
        return $query->getResult();
    }

    public function getTotalMentorPending()
    {
        $query = $this->db->query("
        SELECT COUNT(username) FROM mentor_detail WHERE status_verified = 0
        ");
        return $query->getRow();
    }
    public function getTotalMentorAccept()
    {
        $query = $this->db->query("
        SELECT COUNT(username) FROM mentor_detail WHERE status_verified = 1
        ");
        return $query->getRow();
    }
    public function getTotalMentorDecline()
    {
        $query = $this->db->query("
        SELECT COUNT(username) FROM mentor_detail WHERE status_verified = 2
        ");
        return $query->getRow();
    }
}
