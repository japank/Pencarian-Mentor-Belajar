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
            ];
            $this->users->update($username, $savedata);
<<<<<<< HEAD
            $price_sd = $this->request->getVar('price_sd');
            $price_smp = $this->request->getVar('price_smp');
            $price_sma = $this->request->getVar('price_sma');
            $this->mentor_detail->updatePrice($username, $price_sd, $price_smp, $price_sma);
=======
>>>>>>> b60230be6a74b6e83a6ed782e122e1adfb91890e

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
                // ini eror
                // if (!$this->validate([
                //     'identity_file' => [
                //         'label' => 'File Identitas',
                //         'rules' => 'uploaded[identity_file]'
                //             . '|is_image[identity_file]'
                //             . '|mime_in[identity_file,image/jpg,image/jpeg,image/gif,image/png,image/webp]'
                //             . '|max_size[identity_file,100]'
                //             . '|max_dims[identity_file,1024,768]',
                //     ],
                // ])) {
                //     session()->setFlashdata('error', $this->validator->listErrors());
                //     return redirect()->back()->withInput();
                // } else {

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
    public function changePw()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username');
            $dataUsers = $this->users->where(['username' => $username,])->first();
            $data = [
                'name' => $dataUsers->name,
                'username' => $username

            ];

            $msg = [
                'sukses' => view('change_password', $data)
            ];
            echo json_encode($msg);
        }
    }
    public function updatePw($username)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'old_pw' => [
                    'label' => 'Password Lama',
                    'rules' => "required",
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'new_pw' => [
                    'label' => 'Password Baru',
                    'rules' => 'required|min_length[4]|max_length[50]',
                    'errors' => [
                        'required' => '{field} Harus diisi',
                        'min_length' => '{field} Minimal 4 Karakter',
                        'max_length' => '{field} Maksimal 50 Karakter',
                    ]
                ],
                'new_pw_conf' => [
                    'rules' => 'required|matches[new_pw]',
                    'label' => 'Konfirmasi Password Baru',
                    'errors' => [
                        'matches' => 'Konfirmasi Password tidak sesuai dengan password baru',
                        'required' => '{field} Harus diisi',
                    ]
                ],
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'old_pw' => $validation->getError('old_pw'),
                        'new_pw' => $validation->getError('new_pw'),
                        'new_pw_conf' => $validation->getError('new_pw_conf'),

                    ]
                ];
            } else {

                $dataUser = $this->users->where([
                    'username' => $username,
                ])->first();
                if (password_verify($this->request->getVar('old_pw'), $dataUser->password)) {

                    $savedata = [
                        'password' => password_hash($this->request->getVar('new_pw'), PASSWORD_BCRYPT),

                    ];
                    $this->users->update($username, $savedata);
                    $msg = [
                        'sukses' => 'Password berhasil diubah'
                    ];
                } else {
                    $msg = [
                        'error' => [
                            'old_pw' => 'Passsword Lama Salah',
                            'new_pw' => $validation->getError('new_pw'),
                            'new_pw_conf' => $validation->getError('new_pw_conf'),

                        ]
                    ];
                }
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function tes()
    {
        return view('tes');
    }
}
