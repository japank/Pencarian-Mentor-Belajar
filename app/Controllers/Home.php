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

        return view('tes');
    }
}
