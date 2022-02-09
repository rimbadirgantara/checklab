<?php

namespace App\Models;

use CodeIgniter\Model;

class GedungModel extends Model{

	protected $table = 'gedung';
	protected $useTimestamps = true;

	public function data_gedung()
	{
		return $this->findAll();
	}

	public function ambil_data_gedung_dengan_slug($slug_gedung){
		return $this->where(['slug' => $slug_gedung])->first();	
	}
}