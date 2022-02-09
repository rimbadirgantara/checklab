<?php

namespace App\Controllers;

class Dosen extends BaseController
{
    public function __construct(){
        $this->urlSegment = \Config\Services::request();
    }
    public function index()
    {
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
        }


        $data = [
            'baner' => 'CheckLab',
            'title' => 'Komting Dashboard',
            'name_page' => 'Komting Page',
            'sub_name' => 'Rumah',
            'menuSegment' => $this->urlSegment->uri->getSegment(1)
        ];

        return view('dosen/index', $data);
    }
}
