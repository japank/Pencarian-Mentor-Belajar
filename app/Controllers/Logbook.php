<?php

namespace App\Controllers;

use App\Models\RequestMentorModel;
use App\Models\LogbookModel;
class Logbook extends BaseController
{
    public function __construct()
    {
        $this->requestMentor = new RequestMentorModel();
        $this->logbook = new LogbookModel();
    }
    public function index()
    {
        $mentor = $this->requestMentor->getMentor();
        $usernow = session()->get('username');
        return view('mentor_list',[
        'mentor'=>$mentor,
        'username'=>$usernow,
        ]);
        // $usernow = session()->get('username');
        // $dataLogbook = $this->logbook->getLogbookSiswa($usernow);
        
        // $tes = session()->get('role');
        // return view('logbook_siswa',[
        // 'username'=>$usernow,
        // 'dataLogbook' => $dataLogbook,
        // ]);
    }

    public function indexLogbookAsMentor()
    {
        $siswaMentored = $this->requestMentor->getSiswaMentored();
        $usernow = session()->get('username');
        return view('mentor/list_student',[
        'siswaMentored'=>$siswaMentored,
        'username'=>$usernow,
        ]);
    }

    public function logbook($username){
    $dataLogbook = $this->logbook->getLogbookSiswa($username);
    $usernow = session()->get('username');
    
    return view('logbook_siswa',[
    'username_mentor' => $username,
    'username'=>$usernow,
    'dataLogbook' => $dataLogbook,
    ]);
    }

    public function logbookSiswaByMentor($username){
        $dataLogbookByMentor = $this->logbook->getLogbookSiswaByMentor($username);
        $usernow = session()->get('username');
        
        return view('mentor/logbook_siswa',[
        'username_siswa' => $username,
        'username'=>$usernow,
        'dataLogbook' => $dataLogbookByMentor,
        ]); 
        }

    public function add($username){
        return view('mentor/logbook_add',[
            'username_siswa' => $username,
        ]);
    }

    public function process($username_siswa){
        $this->logbook->insert([
            'username_siswa' => $username_siswa,
            'username_mentor' => $this->request->getVar('username_mentor'),
            'topic' => $this->request->getVar('topic'),
            'topic_description' => $this->request->getVar('topic_description'),
            'date_mentoring'=> $this->request->getVar('date_mentoring'),
            'description' => $this->request->getVar('description')
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('logbook/details/'.$username_siswa);
    }

    public function edit($id){
        $dataLogbook = $this->logbook->find($id);
        $usernow = session()->get('username');
        return view('mentor/logbook_edit',[
        'username'=>$usernow,
        'dataLogbook' => $dataLogbook,
        ]);
    }

    public function update($id){
        $username_siswa = $this->request->getVar('username_siswa');

        $this->logbook->update($id, [
            'topic' => $this->request->getVar('topic'),
            'date_mentoring'=> $this->request->getVar('date_mentoring'),
            'description' => $this->request->getVar('description')
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('logbook/details/'.$username_siswa);
    }

    public function delete($id){
        $dataLogbook = $this->logbook->find($id);
        if (empty($dataLogbook)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak ditemukan !');
        }
        $this->logbook->delete($id);
        session()->setFlashdata('message', 'Hapus Pengajuan Peminjaman Aset Berhasil');
        return redirect()->to('logbook/details/'.$dataLogbook->username_siswa);
    }
}
