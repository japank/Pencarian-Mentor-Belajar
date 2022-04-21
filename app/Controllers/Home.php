<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Home extends BaseController
{
    public function index()
    {
        $users = new UsersModel();
        $usernow = session()->get('username');
        $data['users'] = $users->getjarak();
        return view('home', $data);
    }

    public function tes()
    {
        return view('tes');
    }
}
