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

    public function index()
    {
        $users = new UsersModel();
        $mentor = $users->getjarak();
        $usernow = session()->get('username');
        return view('mentor',[
        'mentor'=>$mentor,
        'username'=>$usernow,
        ]);
    }

    public function indexRequestBySiswa()
    {
            $requestMentor = new RequestMentorModel();
            $requestMentorList = $this->requestMentor->getRequestMentoring();
            $usernow = session()->get('username');
            return view('mentor_request_list',[
            'username'=>$usernow,
            'requestMentorList' => $requestMentorList,
            ]);
        }
    

    public function indexRequestByMentor()
    {

            $requestMentor = new RequestMentorModel();
            $requestMentorList = $this->requestMentor->getRequestMentoringbyMentor();
            $usernow = session()->get('username');
            return view('mentor_request_list_bymentor',[
            'username'=>$usernow,
            'requestMentorList' => $requestMentorList,
        ]);
        }



    public function request($username){
        $dataMentor = $this->users->find($username);
        if (empty($dataMentor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data Pegawai Tidak ditemukan !');
        }
        
        return view('mentor_request',[
        'dataMentor'=>$dataMentor,
    ]);

    }

    public function process(){
        $requestMentor = new RequestMentorModel();
        $usernow = session()->get('username');

        $requestMentor->insert([
            'username_siswa' => $usernow,
            'username_mentor' => $this->request->getVar('username_mentor'),
            'topic' => $this->request->getVar('topic'),
            'description' => $this->request->getVar('description'),
            'date_started'=> $this->request->getVar('date_started'),
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('/mentor/request');
    }

    public function edit($id){
        $dataRequestMentor = $this->requestMentor->find($id);
        $usernow = session()->get('username');
        return view('mentor_request_edit',[
        'username'=>$usernow,
        'dataRequestMentor' => $dataRequestMentor,
        ]);
    }

    public function update($id){
        $requestMentor = new RequestMentorModel();
        $usernow = session()->get('username');

        $requestMentor->update($id, [
            'username_siswa' => $usernow,
            'username_mentor' => $this->request->getVar('username_mentor'),
            'topic' => $this->request->getVar('topic'),
            'date_started'=> $this->request->getVar('date_started'),
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('/mentor/request');
    }

    public function delete($id){
        $dataRequestMentor = $this->requestMentor->find($id);
        if (empty($dataRequestMentor)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Tidak ditemukan !');
        }
        $this->requestMentor->delete($id);
        session()->setFlashdata('message', 'Hapus Pengajuan Peminjaman Aset Berhasil');
        return redirect()->to('/mentor/request');
    }


    public function verification($id){
        $requestMentor = new RequestMentorModel();
        $usernow = session()->get('username');

        $requestMentor->update($id, [
            'status_request' => $this->request->getVar('status_request'),
        ]);
        session()->setFlashdata('message', 'Berhasil');
        return redirect()->to('/mentor/requested');
    }


}
