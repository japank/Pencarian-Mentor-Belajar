<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\RequestMentorModel;

class Mentor extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
        $this->requestMentor = new RequestMentorModel();
    }

    public function indexcheck()
    {
        $latnow = session()->get('latitude');
        if (!empty($latnow)) {
            return redirect()->to('/mentor');
        } else {
            return redirect()->to('/location');
        }
    }

    public function index()
    {
        $usernow = session()->get('username');
        return view('mentor');
        // $users = new UsersModel();
        // $mentorByJarak = $users->getjarak();
        // $mentorByScore = $users->getMentorByScore();
        // $usernow = session()->get('username');
        // return view('mentor', [
        //     'mentor' => $mentorByJarak,
        //     'username' => $usernow,
        // ]);
    }

    // ================================================
    public function allMentor()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'mentor' => $this->users->getjarak(),
                'username' => $usernow
            ];

            $msg = [
                'data' => view('mentorajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
    public function allMentorByScore()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'mentor' => $this->users->getMentorByScore(),
                'username' => $usernow
            ];

            $msg = [
                'data' => view('mentorajax2', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }





    // ==================================================
    public function indexRequestBySiswa()
    {
        // $requestMentor = new RequestMentorModel();
        // $requestMentorList = $this->requestMentor->getRequestMentoring();
        // $usernow = session()->get('username');
        // return view('request_mentor_list', [
        //     'username' => $usernow,
        //     'requestMentorList' => $requestMentorList,
        // ]);

        return view('request_mentor_list');
    }

    public function loadRequestMentorList()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'requestMentorList' => $this->requestMentor->getRequestMentoring(),
                'username' => $usernow
            ];

            $msg = [
                'data' => view('request_mentor_listajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function editRequestMentor()
    {
        if ($this->request->isAJAX()) {

            $dataRequestMentor = $this->requestMentor->find($this->request->getVar('id_request_mentor'));
            $usernow = session()->get('username');
            $data = [
                'username' => $usernow,
                'dataRequestMentor' => $dataRequestMentor,
            ];

            $msg = [
                'sukses' => view('request_mentor_edit_modal', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function updateRequestMentor($id_request_mentor)
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'date_started' => [
                    'label' => 'Tanggal Pertemuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'topic' => [
                    'label' => 'Topik',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'date_started' => $validation->getError('date_started'),
                        'topic' => $validation->getError('topic')

                    ]
                ];
            } else {
                $this->requestMentor->update($id_request_mentor, [
                    'topic' => $this->request->getVar('topic'),
                    'date_started' => $this->request->getVar('date_started'),
                    'description' => $this->request->getVar('description')
                ]);
                $msg = [
                    'sukses' => 'Edit Permintaan Mentoring berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function deleteRequestMentor()
    {
        if ($this->request->isAJAX()) {

            $id_request_mentor = $this->request->getVar('id_request_mentor');
            $this->requestMentor->delete($id_request_mentor);

            $msg = [
                'sukses' => 'Pengajuan Permintaan Mentoring berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }



    public function indexRequestByMentor()
    {

        $requestMentor = new RequestMentorModel();
        $requestMentorList = $this->requestMentor->getRequestMentoringbyMentor();
        $usernow = session()->get('username');
        return view('mentor/request_mentored', [
            'username' => $usernow,
            'requestMentorList' => $requestMentorList,
        ]);
    }



    public function request($username)
    {
        $dataMentor = $this->users->find($username);
        if (empty($dataMentor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pegawai Tidak ditemukan !');
        }

        return view('request_mentor', [
            'dataMentor' => $dataMentor,
        ]);
    }

    public function process()
    {
        $requestMentor = new RequestMentorModel();
        $usernow = session()->get('username');

        $requestMentor->insert([
            'username_siswa' => $usernow,
            'username_mentor' => $this->request->getVar('username_mentor'),
            'topic' => $this->request->getVar('topic'),
            'description' => $this->request->getVar('description'),
            'date_started' => $this->request->getVar('date_started'),
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('/mentor/request');
    }

    public function edit($id)
    {
        $dataRequestMentor = $this->requestMentor->find($id);
        $usernow = session()->get('username');
        return view('request_mentor_edit', [
            'username' => $usernow,
            'dataRequestMentor' => $dataRequestMentor,
        ]);
    }

    public function update($id)
    {
        $requestMentor = new RequestMentorModel();
        $usernow = session()->get('username');

        $requestMentor->update($id, [
            'username_siswa' => $usernow,
            'username_mentor' => $this->request->getVar('username_mentor'),
            'topic' => $this->request->getVar('topic'),
            'date_started' => $this->request->getVar('date_started'),
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('/mentor/request');
    }

    public function delete($id)
    {
        $dataRequestMentor = $this->requestMentor->find($id);
        if (empty($dataRequestMentor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak ditemukan !');
        }
        $this->requestMentor->delete($id);
        session()->setFlashdata('message', 'Hapus Pengajuan Peminjaman Aset Berhasil');
        return redirect()->to('/mentor/request');
    }


    public function verification($id)
    {
        $requestMentor = new RequestMentorModel();
        $usernow = session()->get('username');

        $requestMentor->update($id, [
            'status_request' => $this->request->getVar('status_request'),
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('/mentor/requested');
    }

    public function requestMentor()
    {
        if ($this->request->isAJAX()) {

            $data = [

                'username_mentor' => $this->request->getVar('username_mentor'),
            ];

            $msg = [
                'sukses' => view('request_mentor_modal', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function processingRequest()
    {
        if ($this->request->isAJAX()) {
            $validation = \Config\Services::validation();
            $valid = $this->validate([
                'date_mentoring' => [
                    'label' => 'Tanggal Pertemuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'topic' => [
                    'label' => 'Topik',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'date_mentoring' => $validation->getError('date_mentoring'),
                        'topic' => $validation->getError('topic')
                    ]
                ];
            } else {

                $username_siswa = session()->get('username');
                $this->requestMentor->insert([

                    'username_siswa' => $username_siswa,
                    'username_mentor' => $this->request->getVar('username_mentor'),
                    'topic' => $this->request->getVar('topic'),
                    'description' => $this->request->getVar('topic_description'),
                    'date_started' => $this->request->getVar('date_mentoring'),

                ]);

                $msg = [
                    'sukses' => 'Permintaan Mentoring berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
