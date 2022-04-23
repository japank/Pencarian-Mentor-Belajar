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
        $siswaMentored = $this->requestMentor->getSiswaMentored();
        $usernow = session()->get('username');
        $tes = session()->get('role');
    if($tes == 'siswa'){
    return redirect()->to('logbook/'.$usernow);;
    }else{
        return view('logbook',[
        'siswaMentored'=>$siswaMentored,
        'username'=>$usernow,
        ]);
    }
    }

    public function logbook($username){
    $dataLogbookByMentor = $this->logbook->getLogbookSiswaByMentor($username);
    $dataLogbook = $this->logbook->getLogbookSiswa($username);
    $usernow = session()->get('username');
    
    $tes = session()->get('role');
    if($tes == 'siswa'){
    return view('logbook_siswa',[
    'username'=>$usernow,
    'dataLogbook' => $dataLogbook,
    ]);
    }else{
    return view('logbook_siswa_by_mentor',[
    'username'=>$usernow,
    'dataLogbook' => $dataLogbookByMentor,
    ]); 
    }
    }

}
