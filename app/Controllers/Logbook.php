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

    public function showLogbookStudent()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'username_mentor' => $this->request->getVar('username_mentor'),
                'username_siswa' => $this->request->getVar('username_siswa'),
                'logbook' => $this->logbook->getLogbookSiswa($this->request->getVar('username_mentor')),

            ];

            $msg = [
                'sukses' => view('logbook_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
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

                $dataFile = $this->request->getFile('activity_photo');
                $dataFileName = $dataFile->getName();


                $savedata = [
                    'username_siswa' => $username_siswa,
                    'username_mentor' => $this->request->getVar('username_mentor'),
                    'topic' => $this->request->getVar('topic'),
                    'topic_description' => $this->request->getVar('topic_description'),
                    'date_mentoring' => $this->request->getVar('date_mentoring'),
                    'description' => $this->request->getVar('description'),
                    'activity_photo' => $dataFileName,
                ];

                $this->logbook->insert($savedata);
                $dataFile->move('file/logbook', $dataFileName);

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
            $validation = \Config\Services::validation();
            $valid = $this->validate([
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
                        'topic' => $validation->getError('topic')

                    ]
                ];
            } else {
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
            }

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


    public function showPhoto()
    {
        if ($this->request->isAJAX()) {
            $id_logbook = $this->request->getVar('id_logbook');
            $dataLogbook = $this->logbook->where(['id_logbook' => $id_logbook,])->first();


            $data = [
                'id_logbook' => $id_logbook,
                'date_mentoring' => $dataLogbook->date_mentoring,
                'activity_photo' => $dataLogbook->activity_photo,
            ];

            $msg = [
                'sukses' => view('mentor/photo_logbook_modal', $data)
            ];

            echo json_encode($msg);
        }
    }
    // ADMIINNN
    //Daftar Mentor dari siswa
    public function listMentorFromStudent($username)
    {
        $mentor = $this->requestMentor->getMentor();
        return view('admin/list_mentor_from_student', [
            'mentor' => $mentor,
            'username' => $username,
        ]);
    }

    public function loadListMentorFromStudent($username)
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'list_mentor' => $this->requestMentor->getMentorFromStudent($username),
                'usernow' => $usernow,
                'username_siswa' => $username,
            ];

            $msg = [
                'data' => view('admin/list_mentor_from_student_ajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    //show logbook by siswa side
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
    public function showAllLogbook()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'username_siswa' => $this->request->getVar('username_siswa'),
                'logbook' => $this->logbook->getAllLogbookStudent($this->request->getVar('username_siswa')),

            ];

            $msg = [
                'sukses' => view('admin/logbook_all_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }



    public function mentoredStudent($username_mentor)
    {

        return view('admin/list_mentored_student', [

            'username_mentor' => $username_mentor
        ]);
    }

    public function loadMentoredStudent($username)
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'list_mentored_student' => $this->requestMentor->getMentoredStudent($username),
                'username_mentor' => $username,

            ];

            $msg = [
                'data' => view('admin/list_mentored_student_ajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
    public function showLogbookByMentor()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'username_mentor' => $this->request->getVar('username_mentor'),
                'username_siswa' => $this->request->getVar('username_siswa'),
                'logbook' => $this->logbook->getLogbookSiswaByAdmin($this->request->getVar('username_siswa'), $this->request->getVar('username_mentor')),

            ];

            $msg = [
                'sukses' => view('admin/logbook_by_mentor_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function showAllLogbookFromMentor()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'username_mentor' => $this->request->getVar('username_mentor'),
                'logbook' => $this->logbook->getAllLogbookMentor($this->request->getVar('username_mentor')),

            ];

            $msg = [
                'sukses' => view('admin/logbook_all_by_mentor_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
