<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model{

	protected $table = 'komting';
	protected $useTimestamps = true;

	public function cek_komting($username){
		return $this->where(['username' => $username])->first();
	}

	public function cek_dosen($username){
		$db = \Config\Database::connect();
		$dd = $db->query("SELECT * FROM dosen WHERE username = '$username'");
		return $dd->getRowArray();
	}

	public function cek_laboran($username){
		$db = \Config\Database::connect();
		$dd = $db->query("SELECT * FROM laboran WHERE username = '$username'");
		return $dd->getRowArray();
	}
}