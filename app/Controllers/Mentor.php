<?php

namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\ExamDetailModel;
use App\Models\ExamUserTakeExamModel;
use App\Models\MentorDetailModel;
use App\Models\UsersModel;
use App\Models\RequestMentorModel;

class Mentor extends BaseController
{
    public function __construct()
    {
        $this->users = new UsersModel();
        $this->requestMentor = new RequestMentorModel();
        $this->mentor_detail = new MentorDetailModel();
        $this->exam_detail = new ExamDetailModel();
        $this->course = new CourseModel();
        $this->exam_take = new ExamUserTakeExamModel();
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

    //mentor list from siswa side
    public function index()
    {
        $usernow = session()->get('username');
        return view('mentor', [
            'exam_list' => $this->course->getCourse()
        ]);
    }

    public function allMentor()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');

            if ($this->request->getVar('distance_or_quality') == '1') {

                if ($this->request->getVar('matkul') == 'all' && $this->request->getVar('level') == 'all') {
                    $data = [
                        'mentor' => $this->users->getjarakAll(),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax', $data)
                    ];
                } elseif ($this->request->getVar('matkul') == 'all') {
                    $data = [
                        'mentor' => $this->users->getjarakAllMatkul($this->request->getVar('level')),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax', $data)
                    ];
                } elseif ($this->request->getVar('level') == 'all') {
                    $data = [
                        'mentor' => $this->users->getjarakAllLevel($this->request->getVar('matkul')),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax', $data)
                    ];
                } else {
                    $data = [
                        'mentor' => $this->users->getjarak($this->request->getVar('matkul'), $this->request->getVar('level')),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax', $data)
                    ];
                }
            } elseif (($this->request->getVar('distance_or_quality') == '2')) {
                if ($this->request->getVar('matkul') == 'all' && $this->request->getVar('level') == 'all') {
                    $data = [
                        'mentor' => $this->users->getMentorByScoreAll(),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax_by_score', $data)
                    ];
                } elseif ($this->request->getVar('matkul') == 'all') {
                    $data = [
                        'mentor' => $this->users->getMentorByScoreCustomLevel($this->request->getVar('level')),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax_by_score', $data)
                    ];
                } elseif ($this->request->getVar('level') == 'all') {
                    $data = [
                        'mentor' => $this->users->getMentorByScoreCustomMatkul($this->request->getVar('matkul')),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax_by_score', $data)
                    ];
                } else {
                    $data = [
                        'mentor' => $this->users->getMentorByScoreCustomMatkulLevel($this->request->getVar('matkul'), $this->request->getVar('level')),
                        'username' => $usernow

                    ];
                    $msg = [
                        'data' => view('mentorajax_by_score', $data)
                    ];
                }
            } else {
                $data = [
                    'mentor' => $this->users->getjarakAll(),
                    'username' => $usernow

                ];
                $msg = [
                    'data' => view('mentorajax', $data)
                ];
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }


    public function requestMentor()
    {
        if ($this->request->isAJAX()) {

            $data = [

                'username_mentor' => $this->request->getVar('username_mentor'),
                'matpel' => $this->exam_take->getMatpelMentor($this->request->getVar('username_mentor'))
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
                'time_mentoring' => [
                    'label' => 'Jam',
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
                'topic_description' => [
                    'label' => 'Deskripsi Topik',
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
                        'time_mentoring' => $validation->getError('time_mentoring'),
                        'topic' => $validation->getError('topic'),
                        'topic_description' => $validation->getError('topic_description'),
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
                    'time_mentoring' => $this->request->getVar('time_mentoring'),

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



    // ==================================================
    public function indexRequestBySiswa()
    {
        return view('request_mentor_list');
    }

    public function loadRequestMentorList()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'requestMentorList' => $this->requestMentor->getRequestMentoring(),
                'username' => $usernow,
                'jarak' => $this->users->getjarakForHistoryRequest()
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
                'matpel' => $this->exam_take->getMatpelMentor($this->request->getVar('username_mentor'))
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
                'time_mentoring' => [
                    'label' => 'Jam',
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
                'description' => [
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
                        'time_mentoring' => $validation->getError('time_mentoring'),
                        'topic' => $validation->getError('topic'),
                        'description' => $validation->getError('description')
                    ]
                ];
            } else {
                $this->requestMentor->update($id_request_mentor, [
                    'topic' => $this->request->getVar('topic'),
                    'date_started' => $this->request->getVar('date_started'),
                    'time_mentoring' => $this->request->getVar('time_mentoring'),
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

    public function requestHistoryBySiswa()
    {
        return view('request_mentor_history');
    }

    public function loadRequestHistoryList()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'requestMentorList' => $this->requestMentor->getAccRequestMentoring(),
                'username' => $usernow,
                'jarak' => $this->users->getjarakForHistoryRequest()
            ];

            $msg = [
                'data' => view('request_mentor_history_ajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    // MENTOR

    public function indexRequestByMentor()
    {
        return view('mentor/request_mentored');
    }


    public function loadRequestMentoredList()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'requestMentorList' => $this->requestMentor->getRequestMentoringbyMentor(),
                'username' => $usernow,
                'jarak' => $this->users->getjarakForHistoryRequest(),
            ];

            $msg = [
                'data' => view('mentor/request_mentoredajax', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
    public function requestHistory()
    {
        return view('mentor/request_history');
    }

    public function loadRequestHistory()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'requestMentorList' => $this->requestMentor->getRequestHistorybyMentor(),
                'username' => $usernow,
                'jarak' => $this->users->getjarakForHistoryRequest(),
            ];

            $msg = [
                'data' => view('mentor/request_historyajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function requestAccepted()
    {
        return view('mentor/request_accepted');
    }

    public function loadRequestAccepted()
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'requestMentorList' => $this->requestMentor->getRequestAcceptedbyMentor(),
                'username' => $usernow,
            ];

            $msg = [
                'data' => view('mentor/request_acceptedajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    public function accRequestMentored()
    {
        if ($this->request->isAJAX()) {

            $dataRequestMentor = $this->requestMentor->find($this->request->getVar('id_request_mentor'));

            $this->requestMentor->update($dataRequestMentor->id_request_mentor, [
                'status_request' => '1',
            ]);
            $msg = [
                'sukses' => 'Berhasil Disetujui'
            ];

            echo json_encode($msg);
        }
    }
    public function decRequestMentored()
    {
        if ($this->request->isAJAX()) {

            $dataRequestMentor = $this->requestMentor->find($this->request->getVar('id_request_mentor'));

            $this->requestMentor->update($dataRequestMentor->id_request_mentor, [
                'status_request' => '0',
            ]);
            $msg = [
                'sukses' => 'Berhasil Ditolak'
            ];

            echo json_encode($msg);
        }
    }

    public function requestDone()
    {
        if ($this->request->isAJAX()) {

            $id_request_mentor = $this->request->getVar('id_request');
            $data = [
                'status_mentoring' => '1'
            ];
            $this->requestMentor->update($id_request_mentor, $data);
            $msg = [
                'sukses' => 'Proses Mentoring telah diselesaikan'
            ];

            echo json_encode($msg);
        }
    }


    // ADMIN
    public function accMentor()
    {
        if ($this->request->isAJAX()) {

            $username = $this->request->getVar('username_mentor');
            $this->mentor_detail->updateStatusVerified($username, '1');
            $msg = [
                'sukses' => 'Berhasil Disetujui'
            ];

            echo json_encode($msg);
        }
    }
    public function decMentor()
    {
        if ($this->request->isAJAX()) {
            $username = $this->request->getVar('username_mentor');
            $this->mentor_detail->updateStatusVerified($username, '2');
            $msg = [
                'sukses' => 'Berhasil Ditolak'
            ];

            echo json_encode($msg);
        }
    }

    public function mentoringHistory($username_mentor)
    {

        return view('admin/mentoring_history', [

            'username_mentor' => $username_mentor
        ]);
    }

    public function loadMentoringHistory($username)
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'mentoring' => $this->requestMentor->getMentoringHistory($username),
                'username_mentor' => $username,

            ];

            $msg = [
                'data' => view('admin/mentoring_history_ajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
    public function mentoringHistoryFromSiswa($username_siswa)
    {

        return view('admin/mentoring_history_from_siswa', [

            'username_siswa' => $username_siswa
        ]);
    }

    public function loadMentoringHistoryFromSiswa($username)
    {
        if ($this->request->isAJAX()) {

            $usernow = session()->get('username');
            $data = [
                'mentoring' => $this->requestMentor->getMentoringHistoryFromSiswa($username),
                'username_mentor' => $username,

            ];

            $msg = [
                'data' => view('admin/mentoring_history_from_siswa_ajax', $data)
            ];


            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }
}
