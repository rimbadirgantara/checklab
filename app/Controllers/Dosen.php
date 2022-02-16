<?php

namespace App\Controllers;
use App\Models\ProfilesDosenModel;
use App\Models\GedungModel;
use App\Models\LabModel;
use App\Models\ReservasiModel;
use App\Models\ProfilesKomtingModel;

class Dosen extends BaseController
{
    public function __construct(){
        $this->urlSegment = \Config\Services::request();
        $this->ProfilesDosenModel = new ProfilesDosenModel;
        $this->GedungModel = new GedungModel;
        $this->LabModel = new LabModel;
        $this->ReservasiModel = new ReservasiModel;
        $this->ProfilesKomtingModel = new ProfilesKomtingModel;
    }
    public function index()
    {
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die; 
        }


        $data = [
            'baner' => 'CheckLab',
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Rumah',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_gedung' => $this->GedungModel->data_gedung(),
        ];

        return view('dosen/index', $data);
    }

    public function lab($slug_gedung){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
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
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'List Lab',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_lab' => $this->LabModel->ambil_data_lab($slug_gedung),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];
        return view('dosen/lab', $data);
    }

    public function detail_lab($slug_lab){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
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
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Detail Lab',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_lab' => $this->LabModel->ambil_data_detail_lab($slug_lab),
            'data_reservasi_lab' => $this->ReservasiModel->ambil_data_reservasi($slug_lab),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username'))

        ];
        return view('dosen/detail_lab', $data);
    }

    public function form_reservasi_lab($slug_lab){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
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
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Form Reservasi',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_lab' => $this->LabModel->ambil_data_detail_lab($slug_lab),
            'valid' => \Config\Services::validation(),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username'))
        ];
        return view('dosen/form_reservasi', $data);
    }

    public function send_form($slug_lab){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
        }

        //rules
        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => ['required' => '{field} harus di isi !']
            ],
            'waktuM' => [
                'rules' => 'required',
                'errors' => ['required' => 'harus di isi !']
            ],
            'waktuK' => [
                'rules' => 'required',
                'errors' => ['required' => 'Harus di isi !']
            ]
        ];
        if (! $this->validate($rules)){
            $valid = \Config\Services::validation();
            return redirect()->to('/do/lab/' . $slug_lab . '/form')->withInput()->with('validation', $valid);
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
            return redirect()->to(base_url('/do/lab/'. $slug_lab .'/form/'));
        } elseif ($check_out <= 0){
            session()->setFlashdata('format-waktu-tidak-valid', 'Format waktu tidak valid!'); 
            return redirect()->to(base_url('/dos/lab/'. $slug_lab .'/form/'));
        }

        // update data lab
        $data_total_reservasi = $this->LabModel->ambil_data_detail_lab($slug_lab);
        if ($data_total_reservasi['total_booking'] < 0){
            session()->setFlashdata('total_reservasi_tidak_valid', 'Total booking tidak valid!');
            return redirect()->to(base_url('/do/lab/'. $slug_lab .'/form/'));
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
        return redirect()->to(base_url('/do/lab/'. $slug_lab .'/detail/'));
    }

    public function reservasi(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
        }

        $data = [
            'baner' => 'PolbengCheckLab',
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Reservasi Lst',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_reservasi' => $this->ReservasiModel->ambil_data_reservasi_dengan_username(session()->get('username')),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username'))
        ]; 
        return view('dosen/reservasi_kontrol', $data);
    }

    public function reservasi_del($id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
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
        return redirect()->to(base_url('/re/do'));

    }

    public function info_reservasi($id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
        }
        
        $data = [
            'baner' => 'PolbengCheckLab',
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Reservasi Info',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_reservasi' => $this->ReservasiModel->ambil_data_reservasi_dengan_username(session()->get('username')),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_reservasi' => $this->ReservasiModel->ambil_data_detail_lab_id($id)
        ];
        return view('dosen/form_edit_reservasi', $data);
    }

    public function komting(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
        }


        $data = [
            'baner' => 'CheckLab',
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Komting Lst',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_komting' => $this->ProfilesKomtingModel->findAll()
        ];

        return view('dosen/komting_control/index', $data); 
    }

    public function hapus_komting($id){
        $this->ProfilesKomtingModel->hapus_komting_dengan_id($id);
        session()->setFlashdata('hapuskomting', 'Data berhasil di hapus!');
        return redirect()->to(base_url('/komt'));
    }

    public function info_komting($username){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Komting Info',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username')),
            'data_komting' => $this->ProfilesKomtingModel->ambil_semua_data_dengan_username($username),
            'valid' => \Config\Services::validation()
        ];

        if (empty($data['data_komting'])){
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Maaf, mohon kembali');
        }

        return view('dosen/komting_control/info_komting', $data);
    }

    public function update_komting($username, $id){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
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
            return redirect()->to(base_url('/komt/' . $username . '/info_komting'))->withInput()->with('validation', $validation);
        }

        $this->ProfilesKomtingModel->update_profiles($id, $data_update);
        session()->setFlashdata('berhasileditprofile', 'Berhasil update data!');
        return redirect()->to(base_url('/komt/' . $data_update['username'] . '/info_komting'));
    }

    public function tmbh_kmtng(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
        }

        $data = [
            'baner' => 'CheckLab',
            'title' => 'Dosen Dashboard',
            'name_page' => 'Dosen Page',
            'sub_name' => 'Form Tambah Komting',
            'menuSegment' => $this->urlSegment->uri->getSegment(1),
            'data_gedung' => $this->GedungModel->data_gedung(),
            'data_profile' => $this->ProfilesDosenModel->ambil_semua_data_dengan_username(session()->get('username')),
            'valid' => \Config\Services::validation()
        ];

        return view('dosen/komting_control/form_tambah_komting', $data);
    }

    public function send_data_kmtng(){
        if(! session()->get('username') AND ! session()->get('level') AND ! session()->get('no_dosen') ){
            session()->setFlashdata('login_dulu', 'Silahkan Login Terlebih Dahulu');
            return redirect()->to(base_url('/login'));
        } elseif (session()->get('level') === 'komting'){
            echo 'dosen di larang masuk'; die;
        } elseif (session()->get('level') === 'laboran'){
            echo 'laboran di larang masuk'; die;
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
                return redirect()->to(base_url('/komt/tmbhkomting'))->withInput()->with('validation', $validation);
        }

        $this->ProfilesKomtingModel->save($data_komting);
        session()->setFlashdata('berhasiltambahkomting', 'Berhasil Menambahkan Komting!');
        return redirect()->to(base_url('/komt'));
    }
}
