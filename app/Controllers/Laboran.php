<?php

namespace App\Controllers;
use App\Models\ProfilesLoboranModel;
use App\Models\ProfilesKomtingModel;
use App\Models\ProfilesDosenModel;
use App\Models\GedungModel;
use App\Models\LabModel;
use App\Models\ReservasiModel;


class Laboran extends BaseController
{
    public function __construct(){
        $this->urlSegment = \Config\Services::request();
        $this->ProfilesLaboranModel = new ProfilesLoboranModel;
        $this->ProfilesKomtingModel = new ProfilesKomtingModel;
        $this->ProfilesDosenModel = new ProfilesDosenModel;
        $this->GedungModel = new GedungModel;
        $this->LabModel = new LabModel;
        $this->ReservasiModel = new ReservasiModel;

    }

    public function index()
    {
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }


        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Rumah',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];
        return view('laboran/index', $data);
    }

    public function lab($slug_gedung){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        // redirect jika ada yang utak atik url
        $cek_data_slug = $this->GedungModel->ambil_data_gedung_dengan_slug($slug_gedung);
        if (empty($cek_data_slug['slug'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Hayo mau ngapain? Mau hek lewat sini ya ? => ' . $slug_gedung);
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Rumah',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_lab' => $this->LabModel->ambil_data_lab($slug_gedung),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];
        return view('laboran/lab', $data);
    }

    public function detail_lab($slug_lab){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }


        // redirect jika ada yang utak atik url
        $cek_data_slug = $this->LabModel->ambil_data_detail_lab($slug_lab);
        if (empty($cek_data_slug['slug'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Hayo mau ngapain? Mau hek lewat sini ya ? => ' . $slug_lab);
        }
 
        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Rumah',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_lab' => $this->LabModel->ambil_data_detail_lab($slug_lab),
            'data_reservasi_lab' => $this->ReservasiModel->ambil_data_reservasi($slug_lab),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];

        return view('laboran/detail_lab', $data);
    }

    public function form_reservasi_lab($slug_lab){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
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
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];
        return view('laboran/form_reservasi', $data); 
    }

    public function send_form($slug_lab){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
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
            'nama'      => $nama,
            'username'  => $username,
            'lab'       => $slug_lab,
            'lab__'     => $slug_gedung['nama_lab'],
            'gedung'    => $slug_gedung['nama_gedung'],
            'gedung__'  => $data_gedung['nama_gedung'],
            'check_in'  => $check_in,
            'check_out' => $check_out,
            'status'    => 'Belum diterima',
            'waktu_dibuat' => time()
        ]);
        session()->setFlashdata('berhasilSimpanDataReservasi', 'Berhasil Melakukan Booking!');
        return redirect()->to(base_url('/lab/'. $slug_lab .'/detail/labor'));
    }

    public function reservasi_del($id, $slug_lab){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
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
        session()->setFlashdata('hapusreservasi', 'Data reservasi di hapus!');
        return redirect()->to(base_url('/lab/'. $slug_lab .'/detail/labor'));
    }

    public function info_reservasi($slug_lab, $id){ 

        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Rumah',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_reservasi' => $this->ReservasiModel->ambil_data_detail_lab_id($id),
            'slug_lab' => $slug_lab,
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];

        return view('laboran/form_edit_reservasi', $data); 
    }

    public function edit_reservasi($slug_lab, $id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $rules = [
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'checkin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi'
                ]
            ],

            'checkout' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi'
                ]
            ],

            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi'
                ]
            ]
        ];
        
        if (! $this->validate($rules)){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/lab/'.$slug_lab.'/detail/'.$id.'/info_reservasi'))->withInput()->with('validation', $validation);
        }

        // data update
        $data_update = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'checkin' => strtotime($this->request->getVar('checkin')),
            'checkout' => strtotime($this->request->getVar('checkout')),
            'status' => htmlspecialchars($this->request->getVar('status')),
            'ket' => htmlspecialchars($this->request->getVar('ket'))
        ];


        // cek format waktu
        if ($data_update['checkin'] <= 0) {
            session()->setFlashdata('format-waktu-tidak-valid', 'Format waktu tidak valid!'); 
            return redirect()->to(base_url('/lab/'.$slug_lab.'/detail/'.$id.'/info_reservasi'));
        } elseif ($data_update['checkout'] <= 0) {
            session()->setFlashdata('format-waktu-tidak-valid', 'Format waktu tidak valid!'); 
            return redirect()->to(base_url('/lab/'.$slug_lab.'/detail/'.$id.'/info_reservasi'));
        }

        $this->ReservasiModel->update_data($data_update, $id);
        session()->setFlashdata('update-reservasi-data', 'Berhasil update data '.$data_update['nama'].'!');
        return redirect()->to(base_url('/lab/'.$slug_lab.'/detail/'.$id.'/info_reservasi'));
    }

    public function labor_reservasi(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $data = [
            'baner' => 'PolbengCheckLab',
            'title' => 'Laboran Reservasi', 
            'name_page' => 'Laboran Page',
            'sub_name' => 'Reservasi Lst',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_reservasi' => $this->ReservasiModel->ambil_data_reservasi_dengan_username(session()->get('username')),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];
        // dd($data['data_reservasi']); 
        return view('laboran/reservasi_kontrol', $data);
    }

    public function reservasi_del_labre($id){

        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $data_reservasi = $this->ReservasiModel->ambil_data_detail_lab_id($id);
        $data_lab = $this->LabModel->ambil_data_detail_lab($data_reservasi['lab']);

        if ($data_lab['total_booking'] <= 0){
            $total_booking = 0;
        } elseif ($data_lab['total_booking'] > 0){
            $total_booking = $data_lab['total_booking'] - 1;
        }

        $this->LabModel->update_data($data_lab['slug'], $total_booking);

        $this->ReservasiModel->reservasi_del($id);
        session()->setFlashdata('hapus_reservasi', 'Berhasil hapus data!');
        return redirect()->to(base_url('/labre'));
    }

    public function info_reservasi_labre($id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $slug_lab = $this->ReservasiModel->ambil_data_detail_lab_id($id);
        $data = [
            'baner' => 'PolbengCheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Reservasi Info',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_reservasi' => $this->ReservasiModel->ambil_data_reservasi_dengan_username(session()->get('username')),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_reservasi' => $this->ReservasiModel->ambil_data_detail_lab_id($id),
            'slug_lab' => $slug_lab['lab']
        ];

        return view('laboran/form_edit_reservasi_labre', $data);
    }

    public function edit_reservasi_labre($slug_lab, $id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $rules = [
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'checkin' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi'
                ]
            ],

            'checkout' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi'
                ]
            ],

            'status' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus di isi'
                ]
            ]
        ];
        
        if (! $this->validate($rules)){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/lab/'.$slug_lab.'/detail/'.$id.'/info_reservasi'))->withInput()->with('validation', $validation);
        }

        // data update
        $data_update = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'checkin' => strtotime($this->request->getVar('checkin')),
            'checkout' => strtotime($this->request->getVar('checkout')),
            'status' => htmlspecialchars($this->request->getVar('status')),
            'ket' => htmlspecialchars($this->request->getVar('ket'))
        ];


        // cek format waktu
        if ($data_update['checkin'] <= 0) {
            session()->setFlashdata('format-waktu-tidak-valid', 'Format waktu tidak valid!'); 
            return redirect()->to(base_url('/lab/'.$slug_lab.'/detail/'.$id.'/info_reservasi'));
        } elseif ($data_update['checkout'] <= 0) {
            session()->setFlashdata('format-waktu-tidak-valid', 'Format waktu tidak valid!'); 
            return redirect()->to(base_url('/lab/'.$slug_lab.'/detail/'.$id.'/info_reservasi'));
        }

        $this->ReservasiModel->update_data($data_update, $id);
        session()->setFlashdata('update-reservasi-data', 'Berhasil update data '.$data_update['nama'].'!');
        return redirect()->to(base_url('/labre/'.$id.'/detail/reservasi'));
    }

    public function komting(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }


        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Komting Lst',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_komting' => $this->ProfilesKomtingModel->findAll()
        ];

        return view('laboran/komting_control/index', $data);
    }

    public function info_komting($username){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Komting Info',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_komting' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username($username),
            'valid' => \Config\Services::validation()
        ];

        if (empty($data['data_komting'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Maaf, mohon kembali');
        }

        return view('laboran/komting_control/info_komting', $data);
    }

    public function hapus_komting($id){
        $this->ProfilesKomtingModel->hapus_komting_dengan_id($id);
        session()->setFlashdata('hapuskomting', 'Data berhasil di hapus!');
        return redirect()->to(base_url('/kom'));
    }

    public function update_komting($username, $id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        if (htmlspecialchars($this->request->getVar('status')) === 'Aktif'){
            $status = 'aktif';
        } elseif (htmlspecialchars($this->request->getVar('status')) === 'Non Aktif'){
            $status = 'nonaktif';
        }
        $data_update = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'username' => htmlspecialchars($this->request->getVar('username')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'nim' => htmlspecialchars($this->request->getVar('nim')),
            'jurusan' => htmlspecialchars($this->request->getVar('jurusan')),
            'prodi' => htmlspecialchars($this->request->getVar('prodi')),
            'status' => $status
        ];

        $data_lama = $this->ProfilesKomtingModel->ambil_semua_data_dengan_username($username);

        if ($data_lama['username'] === $data_update['username']){
            $rules_username = 'required|min_length[5]';
        } else {
            $rules_username = 'required|is_unique[komting.username]|min_length[5]';
        }

        if ($data_lama['email'] === $data_update['email']){
            $rules_email = 'required|valid_email';
        } else {
            $rules_email = 'required|is_unique[komting.email]|valid_email';
        }

        if ($data_lama['nim'] === $data_update['nim']){
            $rules_nim = 'required|min_length[10]|numeric';
        } else {
            $rules_nim = 'required|is_unique[komting.nim]|min_length[10]|numeric';
        }


        $rules = [
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'username' => [
                'rules' => $rules_username,
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'email' => [
                'rules' => $rules_email,
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'valid_email' => 'format {field} tidak valid'
                ]
            ],

            'nim' => [
                'rules' => $rules_nim,
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 5 karakter untuk {field}',
                    'numeric' => '{field} harus angka!'
                ]
            ],

            'jurusan' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 6 karakter untuk {field}'
                ]
            ],

            'prodi' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 6 karakter untuk {field}'
                ]
            ],

            'status' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 4 karakter untuk {field}'
                ]
            ]
        ];

        if (! $this->validate($rules)){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/kom/' . $username . '/info_komting'))->withInput()->with('validation', $validation);
        }

        $this->ProfilesKomtingModel->update_profiles($id, $data_update);
        session()->setFlashdata('berhasileditprofile', 'Berhasil update data!');
        return redirect()->to(base_url('/kom/' . $data_update['username'] . '/info_komting'));
    }

    public function tmbh_kmtng(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Form Tambah Komting',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'valid' => \Config\Services::validation()
        ];

        return view('laboran/komting_control/form_tambah_komting', $data);
    }

    public function send_data_kmtng(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        if (htmlspecialchars($this->request->getVar('status')) === 'Aktif'){
            $status = 'aktif';
        } elseif (htmlspecialchars($this->request->getVar('status')) === 'Non Aktif'){
            $status = 'nonaktif';
        }
        $data_komting = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'username' => htmlspecialchars($this->request->getVar('username')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'nim' => htmlspecialchars($this->request->getVar('nim')),
            'jurusan' => htmlspecialchars($this->request->getVar('jurusan')),
            'prodi' => htmlspecialchars($this->request->getVar('prodi')),
            'status' => $status,
            'password' => password_hash($this->request->getVar('realpassword'), PASSWORD_DEFAULT),
            'foto' => 'default.png',
            'level' => 'komting'
        ];


        $rules = [
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'username' => [
                'rules' => 'required|is_unique[komting.username]|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'email' => [
                'rules' => 'required|is_unique[komting.email]|valid_email',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'valid_email' => 'format {field} tidak valid'
                ]
            ],

            'nim' => [
                'rules' => 'required|is_unique[komting.nim]|min_length[10]|numeric',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 10 karakter untuk {field}',
                    'numeric' => '{field} harus angka!'
                ]
            ],

            'jurusan' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 6 karakter untuk {field}'
                ]
            ],

            'prodi' => [
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 6 karakter untuk {field}'
                ]
            ],

            'status' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 4 karakter untuk {field}'
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 3 karakter untuk {field}'
                ]
            ],
            'realpassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'password harus di isi!',
                    'matches' => 'password tidak sama'
                ]
            ]

        ];

        switch ($this->validate($rules)){
            case false:
                $validation = \Config\Services::validation();
                return redirect()->to(base_url('/kom/tmbhkomting'))->withInput()->with('validation', $validation);
        }

        $this->ProfilesKomtingModel->save($data_komting);
        session()->setFlashdata('berhasiltambahkomting', 'Berhasil Menambahkan Komting!');
        return redirect()->to(base_url('/kom'));
    }

    public function dosen(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }


        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Dosen',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_dosen' => $this->ProfilesDosenModel->findAll()
        ];
        
        return view('laboran/dosen_control/index', $data);
    }

    public function info_dsn($username){
         if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Dosen Info',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_dosen' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username($username),
            'valid' => \Config\Services::validation()
        ];

        if (empty($data['data_dosen'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Maaf, mohon kembali');
        }

        return view('laboran/dosen_control/info_komting', $data);
    }

    public function update_dosen($username, $id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        if (htmlspecialchars($this->request->getVar('status')) === 'Aktif'){
            $status = 'aktif';
        } elseif (htmlspecialchars($this->request->getVar('status')) === 'Non Aktif'){
            $status = 'nonaktif';
        }
        $data_update = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'username' => htmlspecialchars($this->request->getVar('username')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'nip' => htmlspecialchars($this->request->getVar('nip')),
            'status' => $status
        ];
        $data_lama = $this->ProfilesDosenModel->ambil_semua_data_dengan_username($username);

        if ($data_lama['username'] === $data_update['username']){
            $rules_username = 'required|min_length[5]';
        } else {
            $rules_username = 'required|is_unique[dosen.username]|min_length[5]';
        }

        if ($data_lama['email'] === $data_update['email']){
            $rules_email = 'required|valid_email';
        } else {
            $rules_email = 'required|is_unique[dosen.email]|valid_email';
        }

        if ($data_lama['nip'] === $data_update['nip']){
            $rules_nim = 'required|min_length[10]|numeric';
        } else {
            $rules_nim = 'required|is_unique[dosen.nip]|min_length[10]|numeric';
        }


        $rules = [
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'username' => [
                'rules' => $rules_username,
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'email' => [
                'rules' => $rules_email,
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'valid_email' => 'format {field} tidak valid'
                ]
            ],

            'nip' => [
                'rules' => $rules_nim,
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 10 karakter untuk {field}',
                    'numeric' => '{field} harus angka!'
                ]
            ],

            'status' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 4 karakter untuk {field}'
                ]
            ]
        ];

        if (! $this->validate($rules)){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/komd/' . $username . '/info_dosen'))->withInput()->with('validation', $validation);
        }

        $this->ProfilesDosenModel->update_data_dosen($id, $data_update);
        session()->setFlashdata('berhasileditprofile', 'Berhasil update data!');
        return redirect()->to(base_url('/komd/' . $data_update['username'] . '/info_dosen'));
    }

    public function hapus_dsn($id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $this->ProfilesDosenModel->delete($id);
        session()->setFlashdata('hapusdosen', 'Data berhasil di hapus!');
        return redirect()->to(base_url('/komd/'));
    }

    public function tambah_dosen(){
      $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Form Tambah Dosen',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'valid' => \Config\Services::validation()
        ];  

        return view('laboran/dosen_control/form_tambah_dosen', $data);
    }

    public function send_data_dosen(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_laboran') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'komting di larang masuk'; die;
        } elseif (session()->get('level') === 'dosen'){
            echo 'dosen di larang masuk'; die;
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Laboran Dashboard',
            'name_page' => 'Laboran Page',
            'sub_name' => 'Rumah',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesLaboranModel->ambil_semua_data_dengan_username(session()->get('username')),
            'valid' => \Config\Services::validation()
        ];

        $rules = [
            'nama' => [
                'rules' => 'required|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'username' => [
                'rules' => 'required|is_unique[dosen.username]|min_length[5]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 5 karakter untuk {field}'
                ]
            ],

            'email' => [
                'rules' => 'required|is_unique[dosen.email]|valid_email',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'valid_email' => 'format {field} tidak valid'
                ]
            ],

            'nip' => [
                'rules' => 'required|is_unique[dosen.nip]|min_length[10]|numeric',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'is_unique' => '{field} sudah di gunakan',
                    'min_length' => 'minimal 10 karakter untuk {field}',
                    'numeric' => '{field} harus angka!'
                ]
            ],

            'password' => [
                'rules' => 'required|min_length[3]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 3 karakter untuk {field}'
                ]
            ],

            'realpassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'password harus di isi!',
                    'matches' => 'password tidak sama'
                ]
            ],

            'status' => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => '{field} harus di isi!',
                    'min_length' => 'minimal 4 karakter untuk {field}'
                ]
            ]
        ];

        if (! $this->validate($rules)){
            $validation = \Config\Services::validation();
            return redirect()->to(base_url('/komd/tmbhdos'))->withInput()->with('validation', $validation);
        }

        if (htmlspecialchars($this->request->getVar('status')) === 'Aktif'){
            $status = 'aktif';
        } elseif (htmlspecialchars($this->request->getVar('status')) === 'Non Aktif'){
            $status = 'nonaktif';
        }

        $data_dosen = [
            'nama' => htmlspecialchars($this->request->getVar('nama')),
            'username' => htmlspecialchars($this->request->getVar('username')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'nip' => htmlspecialchars($this->request->getVar('nip')),
            'password' => password_hash($this->request->getVar('realpassword'), PASSWORD_DEFAULT),
            'status' => $status,
            'foto' => 'default.png',
            'level' => 'dosen'
        ];

        $this->ProfilesDosenModel->save($data_dosen);
        return redirect()->to(base_url('/komd'));
    }
}
