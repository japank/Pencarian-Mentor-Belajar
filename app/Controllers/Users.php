<?php

namespace App\Controllers;

use App\Models\ExamDetailModel;
use App\Models\ExamUserTakeExamModel;
use App\Models\UsersModel;

class Users extends BaseController
{

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->exam_user_take_exam = new ExamUserTakeExamModel();
        $this->exam_detail = new ExamDetailModel();
    }

    public function index()
    {
        $users = new UsersModel();
        // $usernow = session()->get('username');
        // $data['users'] = $users->getjarak();
        $tes = session()->get('role');
        if ($tes == 'pendamping') {
            return view('mentor/home');
        } elseif ($tes = 'admin') {
            return view('admin/home');
        } else {
            return view('home');
        }
    }

    public function tes()
    {
        return view('tes');
    }

    public function mentor()
    {
        return view('admin/list_mentor');
    }

    public function loadMentor()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'list_mentor' => $this->users->getMentorList(),
                'usernow' => $usernow,
                'list_score' => $this->exam_user_take_exam->getMentorListScore(),

            ];

            $msg = [
                'data' => view('admin/list_mentorajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function student()
    {
        return view('admin/list_student');
    }

    public function loadStudent()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'list_student' => $this->users->getStudentList(),
                'usernow' => $usernow
            ];

            $msg = [
                'data' => view('admin/list_studentajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
    public function showLocation()
    {
        if ($this->request->isAJAX()) {
            $lat = $this->request->getVar('lat');
            $long = $this->request->getVar('long');
            $name = $this->request->getVar('name');
            $address = $this->request->getVar('address');


            $data = [
                'lat' => $lat,
                'long' => $long,
                'name' => $name,
                'address' => $address
            ];

            $tes = session()->get('role');
            if ($tes == 'pendamping') {
                $msg = [
                    'sukses' => view('mentor/users_location_modal', $data)
                ];
                echo json_encode($msg);
            } elseif ($tes == 'admin') {
                $msg = [
                    'sukses' => view('admin/users_location_modal', $data)
                ];
                echo json_encode($msg);
            } else {
                $msg = [
                    'sukses' => view('users_location_modal', $data)
                ];
                echo json_encode($msg);
            }
        }
    }
}
