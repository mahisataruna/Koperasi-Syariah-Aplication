<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//Class untuk sistem login

class Auth extends CI_Controller 
{	

	// construct untuk semua method

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}
	
	//disini public function index auth halaman login
	public function index()
	{
		//Mencegah user balik ke auth
		if ($this->session->userdata('email')){
			redirect('user');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'trim|required');

		if($this->form_validation->run() == false){
			$data['title'] = 'Login - Koperasi Syariah Bundo Saiyo Padang';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');	
		} else {
			// dijalankan saat validasi lolos
			$this->_login(); //dibuat agar tidak bisa diakses url atau private
		}

	}

	//fungsi _login
	private function _login()
	{

		$email = $this->input->post('email');
		$password = $this->input->post('password1');
		//query data user
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		//jika usernya ada
		if($user) {
			//jika usernya aktif
			if($user['is_active'] == 1) {
				//cek passwordnya
				if(password_verify($password, $user['password'])) {
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);

					if ($user['role_id'] == 1) {

						$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-bell fa-sm"></i> Selamat datang kembali Admin. </div>');	
						redirect('admin');
					} else {
						$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-bell fa-sm"></i> Selamat datang di Koperasi Syariah Bundo Saiyo Padang. </div>');
						redirect('user');
					}

				} else {
					//jika password salah
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Password anda salah! </div>');
					redirect('auth');	
				}


			} else {
				//jika usernya tidak aktif
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Akun belum diaktivasi, mohon hubungi admin koperasi. </div>');
				redirect('auth');
			}

		} else {
			//jika tidak ada user
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Email anda tidak terdaftar! </div>');
			redirect('auth');
		}
	}

	//method callback_tanggal_lahir belum berhasil 
	public function birtday_method($tgl_lahir)
	{
		if ( strtotime($tgl_lahir) > strtotime('2001-01-01') ) 
		{

			$this->form_validation->set_message(  'birtday_method', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-exclamation-triangle fa-sm"></i> Maaf, kamu harus berumur minimal 20 tahun untuk menjadi anggota koperasi. </div>');
			return FALSE;

		} else {

			return true;
		}
	}
	//end


	//disini function registrasi atau pendaftaran
	public function registration()
	{	
		//Mencegah user balik ke auth
		if ($this->session->userdata('email')){
			redirect('user');
		}

		//form validasi data jika berhasil atau gagal ditambahkan
		$this->form_validation->set_rules('name', 'Name', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]',
			[
				'is_unique' => 'Email sudah terdaftar!'
				//is_unique dapat ditambah agar email tidak ada yang sama
			]); 
		
		$this->form_validation->set_rules('password1', 'Password','required|trim|min_length[8]|matches[password2]',
			[ 	
				'matches' => 'Password tidak sama!', 
				'min_length' => 'Password terlalu pendek!' 
				//Komentar apabila password tidak sama atau pendek
			]);
		$this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
		//matches password 1 dan 2

		//validasi tanggal lahir
		$this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|callback_birtday_method');
		//end

		//validasi nik ktp
		$this->form_validation->set_rules('nik', 'No. KTP', 'required');
		//end

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Registrasi - Koperasi Syariah Bundo Saiyo Padang';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registration');
			$this->load->view('templates/auth_footer');
		} else {
			
			//kalau berhasil maka akan diteruskan ke database
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg', //user akan mendapat gambar default untuk profil
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), //password dienskripsi
				'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
				'nik' => htmlspecialchars($this->input->post('nik', true)),
				'role_id' => 2,
				'is_active' => 0, 
				'date_created' => time()
			];

			//insert ke database :
			$this->db->insert('user', $data); //Data yang didapat akan disimpan pada tabel user
			
			//private function kirim notifikasi anggota baru
			$this->_sendEmail();

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Registrasi berhasil, silahkan lakukan pembayaran Simpanan Pokok untuk aktivasi akun! </div>');
			redirect('auth'); //setelah berhasil registrasi akan otomatis diarahkan ke login page
		}
	}

	private function _sendEmail()
	{
		$config = [

			'protocol'	=> 'smtp',
			'smtp_host'	=> 'ssl://smtp.googlemail.com',
			'smtp_user'	=> 'koperasi.bundosaiyo@gmail.com',
			'smtp_pass' => 'mtgs1996',
			'smtp_port' => 465,
			'mailtype'	=> 'html',
			'charset'	=> 'utf-8',
			'newline'	=> "\r\n"
		];

		$this->email->initialize($config);

		$this->email->from('no-reply-koperasi.bundosaiyo@gmail.com', 'Koperasi Syariah Bundo Saiyo Padang');
		$this->email->to('mahisataruna4@gmail.com');
		$this->email->subject('Aktivasi Anggota');
		$this->email->message('Hallo admin, ada anggota baru yang telah bergabung. Mohon segera di aktivasi. Klik: <a href="http://localhost/aplikasikoperasi/auth">disini!</a>');

		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil keluar! </div>');
		redirect('auth');
	}

	public function blocked()
	{
		$this->load->view('auth/blocked');

	}
}


