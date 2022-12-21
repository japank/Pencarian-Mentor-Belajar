<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Location extends BaseController
{
    public function index()
    {
        if ($this->request->isAJAX()) {

            $msg = [
                'sukses' => view('location_modal')
            ];

            echo json_encode($msg);
        } else {
            // exit('Maaf tidak dapat diproses');
            $tes = session()->get('role');
            if ($tes == 'pendamping') {
                return view('mentor/location', []);
            } elseif ($tes == 'siswa') {
                return view('location_users');
            }
        }
    }

    public function UpdateLocation($usernow)
    {
        if (!$this->validate([
            'address' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                ]
            ],
            'lat2' => [
                'label' => 'Titik',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Harus dipilih, Mohon klik dapatkan lokasi'
                ]
            ],
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }
        $this->users = new UsersModel();
        $this->users->update($usernow, [
            'latitude' => $this->request->getVar('lat2'),
            'longitude' => $this->request->getVar('long2'),
            'address' => $this->request->getVar('address')
        ]);

        $dataUser = $this->users->where([
            'username' => $usernow,
        ])->first();
        session()->set([
            'latitude' => $dataUser->latitude,
            'longitude' => $dataUser->longitude,
            'address' => $dataUser->address,
            'logged_in' => TRUE
        ]);
        return redirect()->to('/mentor');
        // return redirect()->back();
    }
}
