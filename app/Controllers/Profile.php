<?php

namespace App\Controllers;

use App\Models\MentorDetailModel;
use App\Models\UsersModel;

class Profile extends BaseController
{

    public function __construct()
    {
        $this->users = new UsersModel();
        $this->mentor_detail = new MentorDetailModel();
    }
    public function index()
    {
        $dataUsers = $this->users->getProfile();
        $dataMentor = $this->users->getProfileMentor();
        $tes = session()->get('role');
        if ($tes == 'pendamping') {
            return view('mentor/profile', [
                'dataMentor' => $dataMentor,
            ]);
        } elseif ($tes == 'admin') {
            return view('admin/profile', [
                'dataUsers' => $dataUsers,
            ]);
        } else {
            return view('profile', [
                'dataUsers' => $dataUsers,
            ]);
        }
    }


    public function update($username)
    {

        if ($this->request->isAJAX()) {
            $savedata = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'kelas' => $this->request->getVar('kelas'),
                // 'password' => $this->request->getVar('password'),

            ];
            $this->users->update($username, $savedata);


            $dataMentor = $this->mentor_detail->where(['username' => $username,])->first();
            $dataFile = $this->request->getFile('identity_file');
            $dataFileName = $dataFile->getRandomName();


            if ($dataFile->getError() == 4) {
            } else {
                if (is_null($dataMentor->identity_file)) {
                    $this->mentor_detail->updateFile($username, $dataFileName);
                    $dataFile->move('file/identity', $dataFileName);
                } else {
                    unlink('file/identity/' . $dataMentor->identity_file);
                    $this->mentor_detail->updateFile($username, $dataFileName);
                    $dataFile->move('file/identity', $dataFileName);
                }
            }

            $dataUsers = $this->users->where(['username' => $username,])->first();
            $dataProfilePict = $this->request->getFile('profile_picture');
            $dataProfileName = $dataProfilePict->getRandomName();

            if ($dataProfilePict->getError() == 4) {
            } else {
                if (is_null($dataUsers->profile_picture)) {
                    $this->users->updateProfilePict($username, $dataProfileName);
                    $dataProfilePict->move('file/profile', $dataProfileName);
                } else {
                    unlink('file/profile/' . $dataUsers->profile_picture);
                    $this->users->updateProfilePict($username, $dataProfileName);
                    $dataProfilePict->move('file/profile', $dataProfileName);
                }
            }

            $msg = [
                'sukses' => 'Profile berhasil diupdate'
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function updateSiswa($username)
    {

        if ($this->request->isAJAX()) {
            $savedata = [
                'name' => $this->request->getVar('name'),
                'email' => $this->request->getVar('email'),
                'kelas' => $this->request->getVar('kelas'),
                // 'password' => $this->request->getVar('password'),

            ];
            $this->users->update($username, $savedata);

            $dataUsers = $this->users->where(['username' => $username,])->first();
            $dataProfilePict = $this->request->getFile('profile_picture');
            $dataProfileName = $dataProfilePict->getRandomName();

            if ($dataProfilePict->getError() == 4) {
            } else {
                if (is_null($dataUsers->profile_picture)) {
                    $this->users->updateProfilePict($username, $dataProfileName);
                    $dataProfilePict->move('file/profile', $dataProfileName);
                } else {
                    unlink('file/profile/' . $dataUsers->profile_picture);
                    $this->users->updateProfilePict($username, $dataProfileName);
                    $dataProfilePict->move('file/profile', $dataProfileName);
                }
            }

            $msg = [
                'sukses' => 'Profile berhasil diupdate'
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }


    public function showIdentity()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username');
            $dataMentor = $this->mentor_detail->where(['username' => $username,])->first();

            if ($dataMentor->identity_file == null) {
                $msg = [
                    'sukses' => view('mentor/identity_empty_modal')
                ];
            } else {
                $data = [
                    'username' => $username,
                    'identity_file' => $dataMentor->identity_file,
                ];

                $msg = [
                    'sukses' => view('mentor/identity_modal', $data)
                ];
            }

            echo json_encode($msg);
        }
    }

    public function tes()
    {
        return view('tes');
    }
}
