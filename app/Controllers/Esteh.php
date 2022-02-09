<?php

// controller profile

namespace App\Controllers;
use App\Models\ProfilesKomtingModel;
use App\Models\ProfilesLoboranModel;

class Esteh extends BaseController
{

    public function __construct(){
        $this->urlSegment = \Config\Services::request();
        $this->ProfilesKomtingModel = new ProfilesKomtingModel;
        $this->ProfilesLaboranModel = new ProfilesLoboranModel;
    }

    public function komting($username){
        $data = [
            'baner' => 'PolbengCheckLab',
            'title' => 'Komting Profile',
            'name_page' => 'Komting Page',
            'sub_name' => 'Profile', 
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_profile' => $this->ProfilesKomtingModel->ambil_data_dengan_username($username),
            'valid' => \Config\Services::validation()
        ];
        if (empty($data['data_profile'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Hayo mau ngapain? Mau hek lewat sini ya ? => ' . $username);
        }
        return view('profiles/profiles_komting', $data);
        // echo '1';
    }

    public function edit_profile_komting($usernamee){

        session()->setFlashdata('metainance', 'Update profile sedang maintenance!');
        return redirect()->to(base_url('/profiles/' . $usernamee . '/komting'));
        // $username = htmlspecialchars($this->request->getVar('username'));
        // $email = htmlspecialchars($this->request->getVar('email'));
        // $nim = htmlspecialchars($this->request->getVar('nim'));
        // $jurusan = htmlspecialchars($this->request->getVar('jurusan'));
        // $prodi = htmlspecialchars($this->request->getVar('prodi'));
        // $passwordbaru = htmlspecialchars($this->request->getVar('passwordbaru'));
        // $ulangipassword = htmlspecialchars($this->request->getVar('ulangipassword'));

        // $cokcokan_data_username = $this->ProfilesKomtingModel->ambil_data_dengan_username($usernamee);
        // switch ($cokcokan_data_username['username']) {
        //     case $username:
        //         $username_rules = 'required|is_unique[komting.username]|min_length[5]';
        //     default:
        //         $username_rules = 'required|min_length[5]';
        // }
        // $use = '';
        // $cokcokan_data_email = $this->ProfilesKomtingModel->ambil_data_dengan_username($use, $email);
        // switch ($cokcokan_data_email['email']){
        //     case $email:
        //         $email_rules = 'required|is_unique[komting.email]|valid_emails';
        //     default:
        //         $email_rules = 'required|valid_emails';
        // }
        // $cokcokan_data_nim = $this->ProfilesKomtingModel->ambil_data_dengan_username($username = $use, $email = $use, $nim);
        // switch ($cokcokan_data_nim['nim']) {
        //     case $nim:
        //         $nim_rules = 'required|is_unique[komting.nim]|numeric';
        //     default:
        //         $nim_rules = 'required|numeric';
        // }

        // switch ($passwordbaru){
        //     case true:
        //         $passwordbaru_rules = 'min_length[8]';
        //     default:
        //         $passwordbaru_rules = 'min_length[0]';
        // }
        
        // switch ($ulangipassword){
        //     case true:
        //         $ulangipassword_rules = 'min_length[8]|matches[passwordbaru]';
        //     default:
        //         $ulangipassword_rules = 'matches[passwordbaru]';
        // }

        
        // $rules = [
        //     'username' => [
        //         'rules' => $username_rules,
        //         'errors' => [
        //             'required' => '{field} harus di isi!',
        //             'is_unique' => '{field} sudah di gunakan!',
        //             'min_length' => 'minimal 5 karakter {field}'
        //         ]
        //     ],
        //     'email' => [
        //         'rules' => $email_rules,
        //         'errors' => [
        //             'required' => '{field} harus di isi!',
        //             'is_unique' => '{field} sudah di gunakan!',
        //             'valid_emails' => 'gunakan format email yang benar!'
        //         ]
        //     ],
        //     'nim' => [
        //         'rules' => $nim_rules,
        //         'errors' => [
        //             'required' => '{field} harus di isi!',
        //             'is_unique' => '{field} sudah di gunakan!',
        //             'numeric' => 'gunakan angka!'
        //         ]
        //     ],
        //     'jurusan' => [
        //         'rules' => 'required|min_length[5]',
        //         'errors' => [
        //             'required' => '{field} harus di isi!',
        //             'min_length' => 'minimal 5 karakter {field}'
        //         ]
        //     ],
        //     'prodi' => [
        //         'rules' => 'required|min_length[5]',
        //         'errors' => [
        //             'required' => '{field} harus di isi!',
        //             'min_length' => 'minimal 5 karakter {field}'
        //         ]
        //     ],
        //     'passwordbaru' => [
        //         'rules' => $passwordbaru_rules,
        //         'errors' => [
        //             'min_length' => 'minimal 8 karakter'
        //         ]
        //     ],
        //     'ulangipassword' => [
        //         'rules' => $ulangipassword_rules,
        //         'errors' => [
        //             'min_length' => 'minimal 8 karakter',
        //             'matches' => 'password tidak sama!'
        //         ]
        //     ]
        // ];

        // if (! $this->validate($rules)){
        //     $valid = \Config\Services::validation();
        //     return redirect()->to(base_url('/profiles/' . $username) . '/komting')->withInput()->with('validation', $valid);
        // }


        // switch ($ulangipassword){
        //     case true:
        //         $data_profile = [
        //             'username' => htmlspecialchars($this->request->getVar('username')),
        //             'email' => htmlspecialchars($this->request->getVar('email')),
        //             'nim' => $nim,
        //             'jurusan' => $jurusan,
        //             'prodi' => $prodi,
        //             'password' => password_hash($ulangipassword, PASSWORD_DEFAULT)
        //         ];

        //     default:
        //         $data_profile = [
        //             'username' => htmlspecialchars($this->request->getVar('username')),
        //             'email' => htmlspecialchars($this->request->getVar('email')),
        //             'nim' => $nim,
        //             'jurusan' => $jurusan,
        //             'prodi' => $prodi
        //         ];
        // }


        // // update data 
        // $this->ProfilesKomtingModel->update_profiles($usernamee, $data_profile, $ulangipassword);
        // session()->setFlashdata('berhasileditprofile', 'Berhasil melakukan update profile!');
        // return redirect()->to(base_url('/ko/'));
    }

    public function laboran($username){
        $data = [
            'baner' => 'PolbengCheckLab',
            'title' => 'Laboran Profile',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Profile', 
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username($username),
            'valid' => \Config\Services::validation()
        ];
        if (empty($data['data_profile'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Hayo mau ngapain? Mau hek lewat sini ya ? => ' . $username);
        }
        return view('profiles/profiles_laboran', $data);
        // echo '1';
    }

    public function edit_profile_laboran($username){
        session()->setFlashdata('metainance', 'Update profile sedang maintenance!');
        return redirect()->to(base_url('/profiles/' . $username . '/laboran'));
    }
}
