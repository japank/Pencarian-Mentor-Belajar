<?php

namespace App\Controllers;

use App\Models\LogbookModel;
use App\Models\RequestMentorModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $this->users = new UsersModel();
        $this->request_mentor = new RequestMentorModel();
        $this->logbook = new LogbookModel();

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
            return view('admin/home');
        } else {
            return view('home', [
                'dataUsers' => $this->users->getProfile(),
                'total_request' => $this->request_mentor->getTotalRequestByStudent(),
                'total_mentor' => $this->request_mentor->getTotalMentor(),
                'total_bimbingan' => $this->logbook->getTotalBimbingan(),

            ]);
        }
    }

    public function tes()
    {

        return view('tes');
    }
}
