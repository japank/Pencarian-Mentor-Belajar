<?php

namespace App\Controllers;

use App\Models\RequestMentorModel;
use App\Models\LogbookModel;
use PHPUnit\Util\Json;

class Logbook extends BaseController
{
    public function __construct()
    {
        $this->requestMentor = new RequestMentorModel();
        $this->logbook = new LogbookModel();
    }

    // =============================================================================
    // |                                     Students                               |
    // =============================================================================
    public function index()
    {
        $mentor = $this->requestMentor->getMentor();
        $usernow = session()->get('username');
        return view('mentor_list', [
            'mentor' => $mentor,
            'username' => $usernow,
        ]);
    }

    public function logbook($username)
    {
        $dataLogbook = $this->logbook->getLogbookSiswa($username);
        $usernow = session()->get('username');

        return view('logbook_siswa', [
            'username_mentor' => $username,
            'username' => $usernow,
            'dataLogbook' => $dataLogbook,
        ]);
    }
    // =============================================================================
    // |                                     Mentor                               |
    // =============================================================================

    public function indexLogbookAsMentor()
    {
        return view('mentor/list_student_datatable');
    }

    public function liststudent()
    {
        if ($this->request->isAJAX()) {
            $siswaMentored = $this->requestMentor->getSiswaMentored();
            $usernow = session()->get('username');
            $data = [
                'listsiswa' => $siswaMentored,
                'usernow' => $usernow
            ];

            $msg = [
                'data' => view('mentor/list_studentajax', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }



    public function logbookSiswaByMentor($username)
    {
        $data = [
            'username_siswa' => $username,
        ];
        return view('mentor/logbook_siswa', $data);
    }

    public function studentlogbook($username)
    {
        if ($this->request->isAJAX()) {
            $dataLogbookByMentor = $this->logbook->getLogbookSiswaByMentor($username);
            $usernow = session()->get('username');
            $data = [
                'studentlogbook' => $dataLogbookByMentor,
                'usernow' => $usernow
            ];

            $msg = [
                'data' => view('mentor/logbook_siswaajax', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }


    public function addlogbook($username)
    {
        if ($this->request->isAJAX()) {

            $data = [
                'username_siswa' => $username,
            ];

            $msg = [
                'data' => view('mentor/logbook_add_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }


    public function process($username_siswa)
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
                $savedata = [
                    'username_siswa' => $username_siswa,
                    'username_mentor' => $this->request->getVar('username_mentor'),
                    'topic' => $this->request->getVar('topic'),
                    'topic_description' => $this->request->getVar('topic_description'),
                    'date_mentoring' => $this->request->getVar('date_mentoring'),
                    'description' => $this->request->getVar('description')
                ];

                $this->logbook->insert($savedata);

                $msg = [
                    'sukses' => 'Tambah Logbook berhasil'
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function editLogbook()
    {
        if ($this->request->isAJAX()) {
            $id_logbook = $this->request->getVar('id_logbook');
            $dataLogbook = $this->logbook->find($id_logbook);
            $data = [
                'date_mentoring' => $dataLogbook->date_mentoring,
                'topic' => $dataLogbook->topic,
                'topic_description' => $dataLogbook->topic_description,
                'description' => $dataLogbook->description,
                'username_siswa' => $dataLogbook->username_siswa,
                'id_logbook' => $id_logbook
            ];

            $msg = [
                'sukses' => view('mentor/logbook_edit_modal', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function update($id_logbook)
    {
        if ($this->request->isAJAX()) {
            $savedata = [
                'topic' => $this->request->getVar('topic'),
                'topic_description' => $this->request->getVar('topic_description'),
                'date_mentoring' => $this->request->getVar('date_mentoring'),
                'description' => $this->request->getVar('description')
            ];

            $this->logbook->update($id_logbook, $savedata);

            $msg = [
                'sukses' => 'Data Logbook berhasil diupdate'
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function deleteLogbook()
    {
        if ($this->request->isAJAX()) {
            $id_logbook = $this->request->getVar('id_logbook');;
            $this->logbook->delete($id_logbook);
            $msg = [
                'sukses' => 'Data Logbook berhasil dihapus'
            ];
            echo json_encode($msg);
        }
    }

    // ADMIINNN
    public function listMentoredStudentbyAdmin($username)
    {
        $mentor = $this->requestMentor->getMentor();
        $usernow = session()->get('username');
        return view('admin/mentored_student_list', [
            'mentor' => $mentor,
            'username' => $username,
        ]);
    }

    public function loadListMentoredStudent($username)
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'list_mentor' => $this->requestMentor->getMentoredStudent($username),
                'usernow' => $usernow,
                'username_siswa' => $username,
            ];

            $msg = [
                'data' => view('admin/mentored_student_list_ajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function showLogbook()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'username_mentor' => $this->request->getVar('username_mentor'),
                'username_siswa' => $this->request->getVar('username_siswa'),
                'logbook' => $this->logbook->getLogbookSiswaByAdmin($this->request->getVar('username_siswa'), $this->request->getVar('username_mentor')),

            ];

            $msg = [
                'sukses' => view('admin/logbook_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function loadLogbookStudentWithMentor()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'logbook' => $this->logbook->getLogbookSiswaByAdmin($this->request->getVar('username_siswa'), $this->request->getVar('username_mentor')),
            ];

            $msg = [
                'data' => view('admin/logbook_modal_ajax', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function logbookStudent($username)
    {
        $dataLogbook = $this->logbook->getLogbookSiswa($username);
        $usernow = session()->get('username');

        return view('logbook_siswa', [
            'username_mentor' => $username,
            'username' => $usernow,
            'dataLogbook' => $dataLogbook,
        ]);
    }
}
