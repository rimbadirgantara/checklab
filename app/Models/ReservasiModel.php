<?php

namespace App\Models;

use CodeIgniter\Model;

class ReservasiModel extends Model{

	protected $table = 'reservasi';
	protected $useTimestamps = true;
	protected $allowedFields = ['nama', 'username', 'lab', 'lab__', 'gedung__', 'gedung', 'check_in', 'check_out', 'status', 'waktu_dibuat', 'ket', 'status'];

	public function ambil_data_reservasi($slug_lab){ 
		return $this->where(['lab' => $slug_lab])->findAll();
	}

	public function ambil_data_reservasi_dengan_username($username){
		return $this->where(['username' => $username])->findAll();
	}

	public function reservasi_del($id){
		$this->delete($id);
	}

	public function ambil_data_detail_lab_id($id){
		return $this->where(['id' => $id])->first();
	}

	public function update_data($data, $id){
		$this->set('nama', $data['nama']);
		$this->set('check_in', $data['checkin']);
		$this->set('check_out', $data['checkout']);
		$this->set('status', $data['status']);
		$this->set('ket', $data['ket']);
		$this->where('id', $id);
		$this->update();
	}
}