<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Profile extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
    }
    public function index()
    {
        $dataUsers = $this->users->getProfile();
        return view('profile',[
        'dataUsers'=>$dataUsers,
        ]);
    }

    public function tes()
    {
        return view('tes');
    }
}
