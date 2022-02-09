<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilesKomtingModel extends Model{

	protected $table = 'komting';
	protected $useTimestamps = true;
	protected $allowedFields = ['nama', 'username', 'email', 'nim', 'jurusan', 'prodi', 'status', 'password', 'foto'];
	
	public function ambil_data_dengan_username($username = null, $email = null, $nim = null){
		if ($username){
			return $this->where(['username' => $username])->first();	
		} elseif ($email){
			return $this->where(['email' => $email])->first();	
		} elseif ($nim) {
			return $this->where(['nim' => $nim])->first();
		}
	}

	public function ambil_semua_data_dengan_username($username){
		return $this->where(['username' => $username])->first();
	}

	public function update_profiles($id, $data_update){
		$this->set('username', $data_update['username']);
		$this->set('email', $data_update['email']);
		$this->set('nim', $data_update['nim']);
		$this->set('jurusan', $data_update['jurusan']);
		$this->set('prodi', $data_update['prodi']);
		$this->set('status', $data_update['status']);
		$this->where('id', $id);
		$this->update();
	}

	public function hapus_komting_dengan_id($id){
		$this->delete($id);
	}
}