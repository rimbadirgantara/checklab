<?php

namespace App\Models;

use CodeIgniter\Model;

class AplT extends Model{

	protected $table = 'web_thema';
	protected $useTimestamps = true;

	public function aplT($thema = 'light-mode')
	{
		return $this->where(['code' => $thema])->first();
	}
}