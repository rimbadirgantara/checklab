<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilesDosenModel extends Model{

	protected $table = 'dosen';
	protected $useTimestamps = true;
	protected $allowedFields = ['nama', 'username', 'email', 'nip', 'status', 'password'];

	public function ambil_semua_data_dengan_username($username){
		return $this->where(['username' => $username])->first();
	}

	public function update_data_dosen($id, $data_update){
		$this->set('username', $data_update['username']);
		$this->set('email', $data_update['email']);
		$this->set('nip', $data_update['nip']);
		$this->set('status', $data_update['status']);
		$this->where('id', $id);
		$this->update();
	}

}