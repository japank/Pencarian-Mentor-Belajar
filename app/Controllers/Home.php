<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $users = new UsersModel();
        // $usernow = session()->get('username');
        // $data['users'] = $users->getjarak();
        $tes = session()->get('role');
        if ($tes == 'pendamping') {
            return view('mentor/home');
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
