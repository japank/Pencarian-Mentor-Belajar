<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function process()
    {
        $users = new UsersModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $dataUser = $users->where([
            'username' => $username,
        ])->first();
        if ($dataUser) {
            if (password_verify($password, $dataUser->password)) {
                if ($dataUser->status == 1) {
                    session()->set([
                        'username' => $dataUser->username,
                        'name' => $dataUser->name,
                        'address' => $dataUser->address,
                        'role' => $dataUser->role,
                        'latitude' => $dataUser->latitude,
                        'longitude' => $dataUser->longitude,
                        'profile_picture' => $dataUser->profile_picture,
                        'logged_in' => TRUE
                    ]);
                    return redirect()->to(site_url('home'));
                } else {
                    return redirect()->to(site_url('register/activatenow/' . $username));
                }
            } else {
                session()->setFlashdata('error', 'Password Salah');
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Username & Password Salah');
            return redirect()->back();
        }
    }

    function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
