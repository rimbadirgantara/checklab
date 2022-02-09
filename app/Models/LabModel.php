<?php

namespace App\Models;

use CodeIgniter\Model;

class LabModel extends Model{

	protected $table = 'lab';
	protected $useTimestamps = false;
	protected $allowedFields = ['nama_lab', 'nama_gedung', 'total_booking', 'fasilitas', 'slug', 'foto', 'sapa_edit'];

	public function ambil_data_lab($slug_gedung){
		return $this->where(['nama_gedung' => $slug_gedung])->findAll();
	}

	public function ambil_data_detail_lab($slug_lab){
		return $this->where(['slug' => $slug_lab])->first();
	}

	public function update_data($slug_lab, $data_total_r){
		$this->set('total_booking', $data_total_r);
		$this->where('slug', $slug_lab);
		$this->update();	
	}
}