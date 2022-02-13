<?php 

namespace App\Controllers;
use App\Models\GedungModel;
use App\Models\LabModel;
use App\Models\AplT;
use App\Models\ReservasiModel;
use App\Models\ProfilesKomtingModel;

class Komting extends BaseController{
	public function __construct(){
		$this->urlSegment = \Config\Services::request();
		$this->GedungModel = new GedungModel;
		$this->LabModel = new LabModel;
		$this->ReservasiModel = new ReservasiModel;
		$this->ProfilesKomtingModel = new ProfilesKomtingModel;
	}

	// <-- halaman rumah -->

	public function index(){

		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			echo 'dosen di larang masuk'; die; 
		} elseif (session()->get('level') === 'laboran'){ 
			return redirect()->to(base_url('/lab'));
		}

		$data = [
			'baner' => 'PolbengCheckLab',
			'title' => 'Komting Dashboard',
			'name_page' => 'Komting Page',
			'sub_name' => 'Rumah',
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'data_gedung' => $this->GedungModel->data_gedung(),
			'data_profile' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username(session()->get('username'))
		];

		return view('komting/index', $data); 
	}

	public function lab($slug_gedung){
		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			echo 'dosen di larang masuk'; die;
		} elseif (session()->get('level') === 'laboran'){
			echo 'laboran di larang masuk'; die;
		}

		// redirect jika ada yang utak atik url
		$cek_data_slug = $this->GedungModel->ambil_data_gedung_dengan_slug($slug_gedung);
		if (empty($cek_data_slug['slug'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Hayo mau ngapain? Mau hek lewat sini ya ? => ' . $slug_gedung);
		}

		$data = [
			'baner' => 'PolbengCheckLab',
			'title' => 'Komting Dashboard',
			'name_page' => 'Komting Page',
			'sub_name' => 'List Lab',
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'data_lab' => $this->LabModel->ambil_data_lab($slug_gedung),
			'data_profile' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username(session()->get('username'))
		];
		return view('komting/lab', $data);
	}

	public function detail_lab($slug_lab){
		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			echo 'dosen di larang masuk'; die;
		} elseif (session()->get('level') === 'laboran'){
			echo 'laboran di larang masuk'; die;
		}

		// redirect jika ada yang utak atik url
		$cek_data_slug = $this->LabModel->ambil_data_detail_lab($slug_lab);
		if (empty($cek_data_slug['slug'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Hayo mau ngapain? Mau hek lewat sini ya ? => ' . $slug_lab);
		}

		$data = [
			'baner' => 'PolbengCheckLab',
			'title' => 'Komting Dashboard',
			'name_page' => 'Komting Page',
			'sub_name' => 'Detail Lab',
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'data_lab' => $this->LabModel->ambil_data_detail_lab($slug_lab),
			'data_reservasi_lab' => $this->ReservasiModel->ambil_data_reservasi($slug_lab),
			'data_profile' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username(session()->get('username'))

		];
		return view('komting/detail_lab', $data);
	}

	public function form_reservasi_lab($slug_lab){
		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			echo 'dosen di larang masuk'; die;
		} elseif (session()->get('level') === 'laboran'){
			echo 'laboran di larang masuk'; die;
		}

		// redirect jika ada yang utak atik url
		$cek_data_slug = $this->LabModel->ambil_data_detail_lab($slug_lab);
		if (empty($cek_data_slug['slug'])){
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Hayo mau ngapain? Mau hek lewat sini ya ? => ' . $slug_lab);
		}

		$data = [
			'baner' => 'PolbengCheckLab',
			'title' => 'Komting Dashboard',
			'name_page' => 'Komting Page',
			'sub_name' => 'Detail Lab',
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'data_lab' => $this->LabModel->ambil_data_detail_lab($slug_lab),
			'valid' => \Config\Services::validation(),
			'data_profile' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username(session()->get('username'))
		];
		return view('komting/form_reservasi', $data);
	}

	public function send_form($slug_lab){
		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			return redirect()->to(base_url('/do'));
		} elseif (session()->get('level') === 'laboran'){
			return redirect()->to(base_url('/lab'));
		}
		//rules
		$rules = [
			'nama' => [
				'rules' => 'required',
				'errors' => ['required' => '{field} harus di isi !']
			],
			'waktuM' => [
				'rules' => 'required',
				'errors' => ['required' => 'Hharus di isi !']
			],
			'waktuK' => [
				'rules' => 'required',
				'errors' => ['required' => 'Harus di isi !']
			]
		];
		if (! $this->validate($rules)){
			$valid = \Config\Services::validation();
			return redirect()->to('ko/lab/' . $slug_lab . '/form')->withInput()->with('validation', $valid);
		}	

		// ambil data gedung
		$slug_gedung = $this->LabModel->ambil_data_detail_lab($slug_lab);

		// ambil data gedung
		$data_gedung = $this->GedungModel->ambil_data_gedung_dengan_slug($slug_gedung['nama_gedung']);

		// ambil data waktu
		$check_in = strtotime($this->request->getVar('waktuM'));
		$check_out = strtotime($this->request->getVar('waktuK'));
		$nama = htmlspecialchars($this->request->getVar('nama'));
		$username = session()->get('username');

		// cek format waktu
		if ($check_in <= 0) {
			session()->setFlashdata('format-waktu-tidak-valid', 'Format waktu tidak valid!'); 
			return redirect()->to(base_url('/ko/lab/'. $slug_lab .'/form/'));
		} elseif ($check_out <= 0){
			session()->setFlashdata('format-waktu-tidak-valid', 'Format waktu tidak valid!'); 
			return redirect()->to(base_url('/ko/lab/'. $slug_lab .'/form/'));
		}

		// update data lab
		$data_total_reservasi = $this->LabModel->ambil_data_detail_lab($slug_lab);
		if ($data_total_reservasi['total_booking'] < 0){
			session()->setFlashdata('total_reservasi_tidak_valid', 'Total booking tidak valid!');
			return redirect()->to(base_url('/ko/lab/'. $slug_lab .'/form/'));
		}
		$data_total_r = $data_total_reservasi['total_booking'] += 1;
		$this->LabModel->update_data($slug_lab, $data_total_r);

		// insert data ke table reservasi
		$this->ReservasiModel->save([
			'nama' 		=> $nama,
			'username' 	=> $username,
			'lab' 		=> $slug_lab,
			'lab__'		=> $slug_gedung['nama_lab'],
			'gedung' 	=> $slug_gedung['nama_gedung'],
			'gedung__'	=> $data_gedung['nama_gedung'],
			'check_in' 	=> $check_in,
			'check_out' => $check_out,
			'status' 	=> 'Belum diterima',
			'waktu_dibuat' => time()
		]);
		session()->setFlashdata('berhasilSimpanDataReservasi', 'Berhasil Melakukan Booking!');
		return redirect()->to(base_url('/ko/lab/'. $slug_lab .'/detail/'));
	}

	// <-- akhir halaman rumah -->

	public function reservasi(){
		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			echo 'dosen di larang masuk'; die;
		} elseif (session()->get('level') === 'laboran'){ 
			return redirect()->to(base_url('/lab'));
		}

		$data = [
			'baner' => 'PolbengCheckLab',
			'title' => 'Komting Dashboard', 
			'name_page' => 'Komting Page',
			'sub_name' => 'Reservasi Lst',
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'data_reservasi' => $this->ReservasiModel->ambil_data_reservasi_dengan_username(session()->get('username')),
			'data_profile' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username(session()->get('username'))
		];
		// dd($data['data_reservasi']); 
		return view('komting/reservasi_kontrol', $data);
	}

	public function info_reservasi($id){
		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			echo 'dosen di larang masuk'; die;
		} elseif (session()->get('level') === 'laboran'){ 
			return redirect()->to(base_url('/lab'));
		}
		
		$data = [
			'baner' => 'PolbengCheckLab',
			'title' => 'Komting Dashboard',
			'name_page' => 'Komting Page',
			'sub_name' => 'Reservasi Info',
			'menuSegment' => $this->urlSegment->uri->getSegment(1),
			'data_reservasi' => $this->ReservasiModel->ambil_data_reservasi_dengan_username(session()->get('username')),
			'data_profile' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username(session()->get('username')),
			'data_reservasi' => $this->ReservasiModel->ambil_data_detail_lab_id($id)
		];
		return view('komting/form_edit_reservasi', $data);
	}

	public function reservasi_del($id){
		if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('nim') ){
			session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
			return redirect()->to(base_url('/login'));
		} elseif (session()->get('level') === 'dosen'){
			echo 'dosen di larang masuk'; die;
		} elseif (session()->get('level') === 'laboran'){ 
			return redirect()->to(base_url('/lab'));
		}

		// kurangi data total reservasi lab
		$data_lab = $this->ReservasiModel->ambil_data_detail_lab_id($id);
		$data_lab_ = $this->LabModel->ambil_data_detail_lab($data_lab['lab']);

		if ($data_lab_['total_booking'] <= 0){
			$total_booking = 0;
		} elseif ($data_lab_['total_booking'] > 0){
			$total_booking = $data_lab_['total_booking'] - 1;
		}

		$this->LabModel->update_data($data_lab_['slug'], $total_booking);

		// hapus data reservasi
		$this->ReservasiModel->reservasi_del($id);
		session()->setFlashdata('hapus_reservasi', 'Data reservasi di hapus!');
		return redirect()->to(base_url('/re'));

	}
}