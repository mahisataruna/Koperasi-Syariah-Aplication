<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index() 
	{

		$data['title'] = 'Beranda Informasi';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		//ambil data beranda informasi
		$this->load->model('Upload_m');
		$data['berkas'] = $this->Upload_m->getInformasi(); 

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/index',$data);
		$this->load->view('templates/footer');
	}

	//Controller Untuk profil user, admin, pemilik
	public function profil()
	{
		$data['title'] = 'Profil';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('user/profil', $data);
		$this->load->view('templates/footer');
	}
	
	
	public function edit() 
	{
		$data['title'] = 'Edit Profil';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('name', 'Nama Lengkap', 'required|trim');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/edit', $data);
			$this->load->view('templates/footer');

		} else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			$nik = $this->input->post('nik');
			$tgl_lahir = $this->input->post('tgl_lahir');
			$no_hp = $this->input->post('no_hp');
			$alamat = $this->input->post('alamat');

			//cek gambar
			$upload_image = $_FILES['image']['name'];

			if ($upload_image) {
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']		 = '2048';
				$config['upload_path']	 = './assets/img/profile/';
				$this->load->library('upload', $config);

				if ($this->upload->do_upload('image')) {

					$old_image = $data['user']['image'];
					if($old_image != 'default.jpg') {
						unlink(FCPATH . 'assets/img/profile/' . $old_image);
					}

					$new_image = $this->upload->data('file_name');
					$this->db->set('image', $new_image);
				} else {
					echo $this->upload->display_errors();
				}
			}

			//Penambahan pada fitur edit 
			//Penambahan pada fitur edit berdasarkan pada penambahan yang dilakukan oleh user admin, anggota, pemilik

			$this->db->set('name', $name);
			$this->db->set('nik', $nik);
			$this->db->set('tgl_lahir', $tgl_lahir);
			$this->db->set('no_hp', $no_hp);
			$this->db->set('alamat', $alamat);
			$this->db->where('email', $email);
			$this->db->update('user');


			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Profil telah diupdate! </div>');
			redirect('user/profil');
		}

	}

	public function changePassword() 
	{
		$data['title'] = 'Ganti Password';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->form_validation->set_rules('current_password','Current Password', 'required|trim');
		$this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
		$this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[8]|matches[new_password1]');
		
		if ($this->form_validation->run() ==false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('user/changepassword', $data);
			$this->load->view('templates/footer');
		} else {
			$current_password = $this->input->post('current_password');
			$new_password = $this->input->post('new_password1');
			if(!password_verify($current_password, $data['user']['password'])) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
					Password salah! </div>');
				redirect('user/changepassword');
			} else {
				if($current_password == $new_password) {
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> 
						Password baru tidak boleh sama! </div>');
					redirect('user/changepassword');
				} else {
					//rules untuk password yang benar
					$password_hash = password_hash($new_password, PASSWORD_DEFAULT);

					$this->db->set('password', $password_hash);
					$this->db->where('email', $this->session->userdata('email'));
					$this->db->update('user');

					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Password berhasil diganti! </div>');
					redirect('user/changepassword');
				}
			}
		}
		
		
	}	
	//contorller update role_user
	public function edit_role_user()
	{
		$this->load->model('user_m');
		$this->user_m->editroleuser($data,$id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Role user telah diganti! </div>');
		redirect('admin/role');
	}


	//Controller aktivasi anggota baru
	Public function active()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$id = $this->input->post('id');

		$this->db->set('is_active', 1);
		$this->db->where('id',$id);
		$this->db->update('user');

		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Anggota telah diaktivasi! </div>');
		redirect('admin/data_anggota');
	}

	
}




