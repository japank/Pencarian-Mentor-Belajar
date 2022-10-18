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
            return view('location_users');
        }
    }

    public function UpdateLocation($usernow)
    {
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
        return redirect()->to('/');
        // return redirect()->back();
    }
}
