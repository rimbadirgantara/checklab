<?php

namespace App\Controllers;
use App\Models\LoginModel;

class Login extends BaseController
{
	protected $login_m;
	public function __construct(){
		$this->login_komting_m = new LoginModel();
	}
    public function index()
    {
    	$data = [
    		'title' => 'CheckLab',
    		'validation' => \Config\Services::validation() 
    	];

        return view('login/login', $data);
    }

    public function cek(){
    	$v = [
    		'username' => [
    			'rules' => 'required|min_length[3]',
    			'errors' => [
    				'required' => 'Username harus di isi!',
    				'min_length' => 'Username harus lebih dari 3 karakter!'
    			]
    		],

    		'password' => [
    			'rules' => 'required|min_length[3]',
    			'errors' => [
    				'required' => 'Password harus di isi!',
    				'min_length' => 'Password harus lebih dari 3 karakter!'
    			]
    		]
    	];
    	if (! $this->validate($v)){
    		$validation = \Config\Services::validation();
    		return redirect()->to(base_url('/auth'))->withInput()->with('validation', $validation);
    	} 

    	$username = htmlspecialchars($this->request->getVar('username'));
    	$password = htmlspecialchars($this->request->getVar('password'));
    	$level = htmlspecialchars($this->request->getVar('level'));


        if( $level === 'Komting' ){
           $cek_user_ = $this->login_komting_m->cek_komting($username);
    	} elseif ($level === 'Dosen') {
    	   $cek_user_ = $this->login_komting_m->cek_dosen($username);
        } elseif ($level === 'Laboran'){
           $cek_user_ = $this->login_komting_m->cek_laboran($username);            
        }
        //$cek_user_['lab'];
    	if($cek_user_){
    		if($username === $cek_user_['username']){
    			if(password_verify($password, $cek_user_['password'])){
                    if($cek_user_['status'] === 'aktif'){
        				if($cek_user_['level'] === 'komting'){
                            $data_ses = [
                                'nama' => $cek_user_['nama'],
                                'username' => $cek_user_['username'],
                                'level' => $cek_user_['level'],
                                'nim' => $cek_user_['nim']
                            ];
                            session()->set($data_ses);
                            return redirect()->to(base_url('/profiles/'.$data_ses['username'].'/komting'));
                        } elseif ($cek_user_['level'] === 'dosen'){
                            $data_ses = [
                                'nama' => $cek_user_['nama'],
                                'username' => $cek_user_['username'],
                                'level' => $cek_user_['level'],
                                'no_dosen' => $cek_user_['no_dosen']
                            ];
                            session()->set($data_ses);
                            return redirect()->to(base_url('/profiles/'.$data_ses['username'].'/dosen'));
                        } elseif ($cek_user_['level'] === 'laboran'){
                            $data_ses = [
                                'nama' => $cek_user_['nama'],
                                'username' => $cek_user_['username'],
                                'level' => $cek_user_['level'],
                                'no_laboran' => $cek_user_['no_laboran']
                            ];
                            session()->set($data_ses);
                            return redirect()->to(base_url('/lab/'.$cek_user_['lab'].'/detail/labor'));
                        } else {
                            session()->setFlashdata('login_dulu', 'Anda tidak di kenali'); 
                            return redirect()->to(base_url('/auth'));
                        }
                    } else {
                        session()->setFlashdata('login_dulu', 'Akun anda tidak aktif');
                        return redirect()->to(base_url('/auth'));
                    }
    			} else {
    				session()->setFlashdata('login_dulu', 'Password salah');
    				return redirect()->to(base_url('/auth'));
    			}
    		} else {
    			session()->setFlashdata('login_dulu', 'Username salah');
    			return redirect()->to(base_url('/auth'));
    		}
    	} else {
    		session()->setFlashdata('login_dulu', 'User tidak terdaftar');
    		return redirect()->to(base_url('/auth'));
    	}
    }

    public function lgt()
    {
        // berhasil
        $data_ses = [
            'username',
            'level',
            'nim',
            'no_dosen',
            'no_laboran'
        ];
        session()->remove($data_ses);
        session()->destroy();
        return redirect()->to(base_url('/login'));
        // echo ' test'; die;?
    }
}
