<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index() 
	{
		$data['title'] = 'Dashbord';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');
	}

	//Mulai Controller Role 
	public function role()
	{
		$data['title'] = 'Role';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get('user_role')->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_role()
	{
		//form validasi data jika berhasil atau gagal ditambahkan
		$this->form_validation->set_rules('role', 'Role', 'required|trim');

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/data_anggota', $data);
			$this->load->view('templates/footer');
		} else {

			//kalau berhasil maka akan diteruskan ke database
			$data = [
				'role' => htmlspecialchars($this->input->post('role', true))
			];
			//insert ke database :
			$this->db->insert('user_role', $data); //Data yang didapat akan disimpan pada tabel user
			// redirect flash data jika berhasil mendaftar
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Role berhasil ditambahkan. </div>');
			redirect('admin/role'); //setelah berhasil registrasi akan otomatis diarahkan ke login page
		}
	}

	public function edit_role()
	{
		$this->load->model('Admin_m');
		$this->Admin_m->editrole($data,$id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Nama role telah diedit. </div>');
		redirect('admin/role');
	}

	public function delete_role($id=null)
	{
		if (!isset($id)) show_404();
		$this->load->model('admin_m');
		if ($this->admin_m->delete_role($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Role telah dihapus! </div>');
			redirect(site_url('admin/role'));
		}
	}

	public function roleAccess($role_id)
	{
		$data['title'] = 'Role Akses';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$data['role'] = $this->db->get_where('user_role', ['id' => $role_id])->row_array();

		$this->db->where('id !=', 1);

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/role-access', $data);
		$this->load->view('templates/footer');
	}

	public function changeAccess()
	{
		$menu_id = $this->input->post('menuId');
		$role_id = $this->input->post('roleId');

		$data = [

			'role_id' => $role_id,
			'menu_id' => $menu_id
		];

		$result = $this->db->get_where('user_access_menu', $data);

		if($result->num_rows() < 1) {
			$this->db->insert('user_access_menu', $data);
		} else {
			$this->db->delete('user_access_menu', $data);
		}

		$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Hak akses telah diganti! </div>');

	}
	//End Role

	//Mulai data anggota
	public function data_anggota()
	{
		$data['title'] = 'Data Anggota';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$data['user'] = $this->db->get_where('user', ['email'])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/data_anggota', $data);
		$this->load->view('templates/footer');	
	}

	public function edit_anggota()
	{
		$this->load->model('User_m');
		$this->User_m->editanggota($data,$id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Data anggota berhasil diedit. </div>');
		redirect('admin/data_anggota');
	}

	public function detail_anggota($id)
	{
		$data['title'] = 'Detail Anggota';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$data['detail'] = $this->db->get_where('user', ['id' => $id])->row_array();

		$this->load->model('Admin_m');
		$data['simpanP'] = $this->Admin_m->getSimpanP($id);
		$data['simpanA'] = $this->Admin_m->getSimpanA($id); 
		$data['pinjamA'] = $this->Admin_m->getPinjamA($id); 
		$data['infaqA'] = $this->Admin_m->getInfaqA($id);
		$data['data_anggota'] = $this->db->get('user')->result_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/detail_anggota', $data);
		$this->load->view('templates/footer');
	}	

	public function tambah_anggota()
	{	
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

		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('admin/data_anggota', $data);
			$this->load->view('templates/footer');
		} else {

			//kalau berhasil maka akan diteruskan ke database
			$data = [
				'name' => htmlspecialchars($this->input->post('name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'image' => 'default.jpg', //user akan mendapat gambar default untuk profil
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), //password dienskripsi
				'nik' => htmlspecialchars($this->input->post('nik', true)),
				'tgl_lahir' => htmlspecialchars($this->input->post('tgl_lahir', true)),
				'no_hp' => htmlspecialchars($this->input->post('no_hp', true)),
				'alamat' => htmlspecialchars($this->input->post('alamat', true)),
				'role_id' => 2,
				'is_active' => 0, //Jika belum di aktivasi admin.
				'date_created' => time()
			];

			//insert ke database :
			$this->db->insert('user', $data); //Data yang didapat akan disimpan pada tabel user
			// redirect flash data jika berhasil mendaftar
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Anggota berhasil ditambahkan, silahkan lakukan aktivasi! </div>');
			redirect('admin'); //setelah berhasil registrasi akan otomatis diarahkan ke login page
		}
	}

	public function editanggota()
	{
		$data['title'] = 'Edit Data Anggota';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
	}

	public function delete_anggota($id=null)
	{
		if (!isset($id)) show_404();
		$this->load->model('user_m');
		if ($this->user_m->delete($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Anggota telah dihapus! </div>');
			redirect(site_url('admin/data_anggota'));
		}
	}
	//End Anggota

	//Controller beranda informasi administrator
	public function informasi() 
	{
		$data['title'] = 'Beranda Informasi';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		
		$this->load->model('Upload_m');
		$data['berkas'] = $this->Upload_m->getInformasi(); 
		
		//$data['berkas'] = $this->db->get('upload');

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/informasi',$data);
		$this->load->view('templates/footer');
	}

	public function edit_informasi()
	{
		$id_berkas = $this->input->post('id_berkas');

		$config['allowed_types'] = 'pdf|gif|jpg|png';
		$config['max_size']		 = '2048';
		$config['upload_path']	 = './assets/informasi/';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('berkas'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('admin/informasi', $error);
		}
		else
		{
			$name_berkas = $this->input->post('name_berkas');
			$keterangan = $this->input->post('keterangan');
			$tanggal = $this->input->post('tanggal');
			$berkas = $this->upload->data('file_name');
			$data = array(
				'name_berkas' => $name_berkas,
				'keterangan' => $keterangan,
				'tanggal' => $tanggal,
				'berkas' => $berkas,
			);
			$this->db->set($data);
		}	

		$where = array('id_berkas' => $id_berkas); 

		$this->load->model('Upload_m');
		$this->Upload_m->editinformasi($where, $data,'upload');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Informasi koperasi telah diedit. </div>');
		redirect('admin/informasi');
	}

	public function create() 
	{
		$data['title'] = 'Tambah Informasi';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer');

	}

	public function proses() 
	{
		$config['allowed_types'] = 'pdf|gif|jpg|png';
		$config['max_size']		 = '2048';
		$config['upload_path']	 = './assets/informasi/';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('berkas'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('admin/informasi', $error);
		}
		else
		{
			$data['name_berkas'] = $this->input->post("name_berkas");
			$data['keterangan'] = $this->input->post('keterangan');
			$data['tanggal'] = $this->input->post('tanggal');
			$data['berkas'] = $this->upload->data('file_name');
			$this->db->insert('upload',$data);
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Informasi koperasi berhasil ditambahkan! </div>');
			redirect('admin/informasi');
		}
	}
	public function delete_informasi($id_berkas=null)
	{
		if (!isset($id_berkas)) show_404();
		$this->load->model('Upload_m');
		if ($this->Upload_m->delete($id_berkas)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Informasi telah dihapus! </div>');
			redirect(site_url('admin/informasi'));
		}
	}
	//End
}

