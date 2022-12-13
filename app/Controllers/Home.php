<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $this->users = new UsersModel();
        // $usernow = session()->get('username');
        // $data['users'] = $users->getjarak();
        $tes = session()->get('role');
        if ($tes == 'pendamping') {
            $dataMentor = $this->users->getProfileMentor();
            return view('mentor/profile', [
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
        $config['protocol'] = 'mail';
        $config['SMTPHost'] = 'ssl://smtp.googlemail.com';
        $config['SMTPPort']  = '587';
        $config['SMTPUser']  = 'jevinarda@gmail.com';
        $config['SMTPPass']  = 'cabmimnlywzrkjew';



        $email = \Config\Services::email();
        $email->initialize($config);
        $email->setFrom('jevinarda@gmail.com', 'Activate the account');
        $email->setTo('nycticorax25@gmailcom');
        $email->setSubject('Activate the accounttt');
        $email->setMessage('testinggg');
        $email->send();

        $cek = $email->printDebugger(['headers']);
        print_r($cek);
        // if ($email->send()) {
        //     echo " terkirim";
        // }
        // print_r($cek);
        // echo "gagal";

        // return view('tes');
    }
}
