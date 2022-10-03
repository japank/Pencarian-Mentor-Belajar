<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Users extends BaseController
{

    public function __construct()
    {
        $this->users = new UsersModel();
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
                'usernow' => $usernow
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
}
