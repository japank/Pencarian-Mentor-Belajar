<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Trainers extends BaseController
{
    public function index()
    {
        $users = new UsersModel();
        $usernow = session()->get('username');
        $data['users'] = $users->getjarak();
        return view('trainers', $data);
    }

}
