<?php

namespace App\Controllers;

use App\Models\RequestMentorModel;
use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $this->users = new UsersModel();
        $this->request_mentor = new RequestMentorModel();

        $dataMentor = $this->users->getProfileMentor();

        $tes = session()->get('role');
        if ($tes == 'pendamping') {


            return view('mentor/home', [
                'total_request' => $this->request_mentor->getTotalRequest(),
                'total_student_mentored' => $this->request_mentor->getTotalStudentMentored(),
                'total_request_decline' => $this->request_mentor->getTotalRequestDecline(),
                'dataMentor' => $dataMentor,
            ]);
        } elseif ($tes == 'admin') {
            return view('admin/home');
        } else {
            return view('home');
        }
    }

    public function tes()
    {

        return view('tes');
    }
}
