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
    }

    public function showLogbookStudent()
    {
        if ($this->request->isAJAX()) {

            $data = [
                'request_mentor' => $this->requestMentor->where(['id_request_mentor' => $this->request->getVar('id_request_mentor')])->first(),
                'logbook' => $this->logbook->getLogbookSiswa($this->request->getVar('id_request_mentor')),
                'username_mentor' => $this->request->getVar('username_mentor'),
                'username_siswa' => $this->request->getVar('username_siswa'),
            ];

            $tes = session()->get('role');
            if ($tes == 'siswa') {
                $msg = [
                    'sukses' => view('logbook_modal', $data)
                ];
            } elseif ($tes == 'admin') {
                $msg = [
                    'sukses' => view('admin/logbook_modal', $data)
                ];
            } else {
            }

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    // =============================================================================
    // |                                     Mentor                               |
    // =============================================================================

    public function detail($id_request)
    {
        $data = [
            'requestDetail' => $this->requestMentor->where(['id_request_mentor' => $id_request,])->first(),
            'id_request' => $id_request
        ];
        return view('mentor/logbook', $data);
    }

    public function loadDetail($id_request)
    {
        if ($this->request->isAJAX()) {
            $dataLogbookByMentor = $this->logbook->getLogbook($id_request);
            $usernow = session()->get('username');
            $data = [
                'studentlogbook' => $dataLogbookByMentor,
                'usernow' => $usernow,
                'id_request' => $id_request,
                'requestDetail' => $this->requestMentor->where(['id_request_mentor' => $id_request,])->first(),
            ];

            $msg = [
                'data' => view('mentor/logbookajax', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }

    // 


    public function addlogbook($id_request)
    {
        if ($this->request->isAJAX()) {
            $dataLogbookByMentor = $this->logbook->getLogbook($id_request);
            $dateRequest = $this->requestMentor->where(['id_request_mentor' => $id_request,])->first();
            $datementoring = explode(",", $dateRequest->date_started);
            $data = [
                'dataLogbook' => $dataLogbookByMentor,
                'id_request' => $id_request,
                'datementoring' => $datementoring

            ];

            $msg = [
                'data' => view('mentor/logbook_add_modal', $data)
            ];

            echo json_encode($msg);
        } else {
            exit('Maaf tidak dapat diproses');
        }
    }


    public function process($id_request)
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

            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'date_mentoring' => $validation->getError('date_mentoring'),

                    ]
                ];
            } else {

                $dataFile = $this->request->getFile('activity_photo');
                $dataFileName = $dataFile->getName();

                $savedata = [
                    'id_request_mentor' => $id_request,
                    'date_mentoring' => $this->request->getVar('date_mentoring'),
                    'mentoring_description' => $this->request->getVar('description'),
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

            $dateRequest = $this->requestMentor->where(['id_request_mentor' => $this->request->getVar('id_request'),])->first();
            $datementoring = explode(",", $dateRequest->date_started);
            $data = [
                'datementoring' => $datementoring,
                'description' => $dataLogbook->mentoring_description,
                'activity_photo' => $dataLogbook->activity_photo,
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
                'date_mentoring' => [
                    'label' => 'Tanggal Pertemuan',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong',
                    ],
                ],
                'description' => [
                    'label' => 'Deskripsi Pertemuan',
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
                    ]
                ];
            } else {




                $dataFile = $this->request->getFile('activity_photo');
                $dataFileName = $dataFile->getRandomName();


                if ($dataFile->getError() == 4) {
                    $savedata = [
                        'date_mentoring' => $this->request->getVar('date_mentoring'),
                        'mentoring_description' => $this->request->getVar('description')
                    ];
                    $this->logbook->update($id_logbook, $savedata);
                } else {
                    $dataLogbook = $this->logbook->where(['id_logbook' => $id_logbook,])->first();
                    unlink('file/logbook/' . $dataLogbook->activity_photo);
                    $savedata = [
                        'date_mentoring' => $this->request->getVar('date_mentoring'),
                        'mentoring_description' => $this->request->getVar('description'),
                        'activity_photo' => $dataFileName
                    ];
                    $this->logbook->update($id_logbook, $savedata);
                    $dataFile->move('file/logbook', $dataFileName);
                }

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
            $id_logbook = $this->request->getVar('id_logbook');
            $dataLogbook = $this->logbook->where(['id_logbook' => $id_logbook,])->first();
            unlink('file/logbook/' . $dataLogbook->activity_photo);
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
}
