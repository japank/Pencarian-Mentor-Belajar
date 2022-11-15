<?php

namespace App\Controllers;

use App\Models\MentorDetailModel;
use App\Models\UsersModel;

class Register extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function process()
    {
        if (!$this->validate([
            'username' => [
                'rules' => 'required|min_length[4]|max_length[20]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 20 Karakter',
                    'is_unique' => 'Username sudah digunakan sebelumnya'
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[4]|max_length[50]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 50 Karakter',
                ]
            ],
            'password_conf' => [
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password',
                ]
            ],
            'name' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
            'email' => [
                'rules' => 'required|min_length[4]|max_length[100]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                ]
            ],
            'kelas' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus diisi'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        helper('text');
        $data['u_link'] = random_string('alnum', 20);
        $message = "Please activate the account" . anchor('register/activate/' . $data['u_link'], 'Activate Now', '');


        $users = new UsersModel();

        $users->insert([
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT),
            'name' => $this->request->getVar('name'),
            'email' => $this->request->getVar('email'),
            'kelas' => $this->request->getVar('kelas'),
            'role' => $this->request->getVar('role'),
            'link' => $data['u_link'],
        ]);

        $getRole = $this->request->getVar('role');
        if ($getRole == 'pendamping') {
            $mentor_detail = new MentorDetailModel();
            $mentor_detail->insert([
                'username' => $this->request->getVar('username'),
            ]);
        }

        $email = \Config\Services::email();
        $email->setFrom('jevinarda@gmail.com', 'Activate the account');
        $email->setTo($this->request->getVar('email'));
        $email->setSubject('Activate the accounttt');
        $email->setMessage(($message));
        $email->send();
        $email->printDebugger(['headers']);

        return redirect()->to('/login');
    }

    public function activate($linkHere)
    {
        // echo $linkHere;
        $users = new UsersModel();
        $checkUserLink = $users->where('link', $linkHere)->findAll();
        // echo $checkUserLink[0]->username;
        if (count($checkUserLink) > 0) {
            $data['status'] = 1;
            $activateUser = $users->update($checkUserLink[0]->username, $data);
            if ($activateUser) {
                return view('activated_success');
            } else {
                echo 'not found';
            }
        } else {
            echo 'link not found';
        }

        // var_dump($checkUserLink);
    }

    public function activatenow($username)
    {
        helper('text');
        $data['u_link'] = random_string('alnum', 20);
        $message = "Please activate the account" . anchor('register/activate/' . $data['u_link'], 'Activate Now', '');

        $users = new UsersModel();
        $dataUser = $users->where([
            'username' => $username,
        ])->first();
        $data = [
            'link' => $data['u_link'],
        ];
        $users->update($username, $data);

        $email = \Config\Services::email();
        $email->setFrom('jevinarda@gmail.com', 'Activate the account');
        $email->setTo($dataUser->email);
        $email->setSubject('Activate the accounttt');
        $email->setMessage(($message));
        $email->send();
        $email->printDebugger(['headers']);

        return view('activate_check_email');
    }
}
