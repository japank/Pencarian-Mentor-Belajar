<?php

namespace App\Controllers;

use App\Models\ExamDetailModel;
use App\Models\LogbookModel;
use App\Models\MentorDetailModel;
use App\Models\RequestMentorModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $this->users = new UsersModel();
        $this->request_mentor = new RequestMentorModel();
        $this->logbook = new LogbookModel();
        $this->exam_detail = new ExamDetailModel();
        $this->mentor_detail = new MentorDetailModel();

        $tes = session()->get('role');
        if ($tes == 'pendamping') {


            return view('mentor/home', [
                'total_request' => $this->request_mentor->getTotalRequest(),
                'total_student_mentored' => $this->request_mentor->getTotalStudentMentored(),
                'total_request_decline' => $this->request_mentor->getTotalRequestDecline(),
                'total_bimbingan' => $this->logbook->getTotalBimbinganByMentor(),
                'dataMentor' => $this->users->getProfileMentor(),
            ]);
        } elseif ($tes == 'admin') {
            return view('admin/home', [
                'total_all_mentor' => $this->users->getTotalAllMentor(),
                'total_all_student' => $this->users->getTotalAllStudent(),
                'total_test' => $this->exam_detail->getTotalTest(),
                'mentor_pending' => $this->mentor_detail->getTotalMentorPending(),
                'mentor_accept' => $this->mentor_detail->getTotalMentorAccept(),
                'mentor_decline' => $this->mentor_detail->getTotalMentorDecline(),
            ]);
        } elseif ($tes == 'siswa') {
            return view('home', [
                'dataUsers' => $this->users->getProfile(),
                'total_request' => $this->request_mentor->getTotalRequestByStudent(),
                'total_mentor' => $this->request_mentor->getTotalMentor(),
                'total_bimbingan' => $this->logbook->getTotalBimbingan(),

            ]);
        } else {
            return view('welcome_page');
        }
    }

    public function tes()
    {

        return view('tes');
    }
}
