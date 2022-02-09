<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfilesLoboranModel extends Model{
	protected $table = 'laboran';
	protected $useTimestamps = true;

	public function ambil_semua_data_dengan_username($username){
		return $this->where(['username' => $username])->first();
	}

}