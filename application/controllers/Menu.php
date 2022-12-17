<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Class pertama Admin
class Menu extends CI_Controller 
{
	private $_table2 = "berita";

	public function __construct() //Untuk mencegah orang masuk jika tidak ada session
	{
		parent::__construct();
		is_logged_in();
	}
	
	//Controller Menu
	public function index()
	{
		$data['title'] = 'Menu Management';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('menu', 'Menu', 'required'); //form validasi untuk menu
		
		if ($this->form_validation->run() == false) {

			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/index', $data);
			$this->load->view('templates/footer');

		} else {
			$this->db->insert('user_menu', ['menu' => $this->input->post('menu')]);
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Menu berhasil ditambahkan! </div>');
			redirect('menu');
		}

	}
	public function edit_menu()
	{
		$this->load->model('Menu_model');
		$this->Menu_model->editmenu($data,$id);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Menu telah diedit! </div>');
		redirect('menu');
	}

	public function delete_menu($id=null)
	{
		if (!isset($id)) show_404();
		$this->load->model('Menu_model');
		if ($this->Menu_model->deletemenu($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Menu telah dihapus! </div>');
			redirect(site_url('menu'));
		}
	}

	//Controller Submenu
	public function submenu() //join table menu pada Menu_model
	{
		$data['title'] = 'Submenu Management';
		$data['user'] = $this->db->get_where('user', ['email' => 
			$this->session->userdata('email')])->row_array();
		$this->load->model('Menu_model', 'menu');

		$data['subMenu'] = $this->menu->getSubMenu();
		$data['menu'] = $this->db->get('user_menu')->result_array();

		$this->form_validation->set_rules('title', 'Title', 'required');
		$this->form_validation->set_rules('menu_id', 'Menu', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');
		$this->form_validation->set_rules('icon', 'Icon', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('menu/submenu', $data);
			$this->load->view('templates/footer');				

		} else {
			$data = [

				'title' => $this->input->post('title'),
				'menu_id' => $this->input->post('menu_id'),
				'url' => $this->input->post('url'),
				'icon' => $this->input->post('icon'),
				'is_active' => $this->input->post('is_active') 
			];
			$this->db->insert('user_sub_menu', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Submenu berhasil ditambahkan. </div>');
			redirect('menu/submenu');

		}
	}

	public function edit_submenu()
	{
		$id = $this->input->post('id');
		$this->load->model('Menu_model');
		$this->Menu_model->editsubmenu($id,$data);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Submenu telah diedit! </div>');
		redirect('menu/submenu');
	}

	public function delete_submenu($id=null)
	{
		if (!isset($id)) show_404();
		$this->load->model('Menu_model');
		if ($this->Menu_model->deletesubmenu($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Submenu telah dihapus! </div>');
			redirect(site_url('menu/submenu'));
		}	
	}
	//End

	//Mulai controller menu galery
	public function gallery()
	{
		$data['title'] = 'Gallery Management';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/gallery', $data);
		$this->load->view('templates/footer');
	}

	public function proses_gallery() 
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('menu/gallery');
		$this->load->view('templates/footer');

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']		 = '2048';
		$config['upload_path']	 = './assets/img/gallery/';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('berkas'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('menu/gallery', $error);
		}
		else
		{
			$data['name_foto'] = $this->input->post('name_foto');
			$data['tanggal'] = $this->input->post('tanggal');
			$data['tag'] = $this->input->post('tag');
			$data['author'] = $this->input->post('author');
			$data['berkas'] = $this->upload->data('file_name');
			$this->db->insert('gallery',$data);
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Gallery website koperasi telah ditambahkan! </div>');
			redirect('menu/gallery');
		}
	}

	public function edit_gallery()
	{
		$id_gallery = $this->input->post('id_gallery');

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']		 = '2048';
		$config['upload_path']	 = './assets/img/gallery/';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('berkas'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('menu/gallery', $error);
		}
		else
		{
			$name_foto = $this->input->post('name_foto');
			$tanggal = $this->input->post('tanggal');
			$tag = $this->input->post('tag');
			$author = $this->input->post('author');
			$berkas = $this->upload->data('file_name');
			$data = array(
				'name_foto' => $name_foto,
				'tanggal' => $tanggal,
				'tag' => $tag,
				'author' => $author,
				'berkas' => $berkas,
			);
			$this->db->set($data);
		}	

		$where = array('id_gallery' => $id_gallery); 

		$this->load->model('Menu_model');
		$this->Menu_model->editgallery($where, $data,'gallery');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Gallery website koperasi telah diedit! </div>');
		redirect('menu/gallery');
	}

	public function delete_gallery($id_gallery=null)
	{
		if (!isset($id_gallery)) show_404();
		$this->load->model('Menu_model');
		if ($this->Menu_model->deletegallery($id_gallery)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Gallery website koperasi telah dihapus! </div>');
			redirect(site_url('menu/gallery'));
		}
	}
	//END Controller Gallery

	//Mulai Controller Menu Berita
	public function berita()
	{
		$data['title'] = 'Berita Management';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Menu_model');
		$data['berita'] = $this->Menu_model->getBerita(); 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('menu/berita', $data);
		$this->load->view('templates/footer');
	}

	public function proses_berita() 
	{
		
		
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('templates/topbar');
		$this->load->view('menu/berita');
		$this->load->view('templates/footer');

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']		 = '2048';
		$config['upload_path']	 = './assets/img/berita/';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('berkas'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('menu/berita', $error);
		}
		else
		{
			$data['judul'] = $this->input->post('judul');
			$data['tanggal'] = $this->input->post('tanggal');
			$data['tag'] = $this->input->post('tag');
			$data['author'] = $this->input->post('author');
			$data['tulis_artikel'] = $this->input->post('tulis_artikel');
			$data['berkas'] = $this->upload->data('file_name');
			$this->db->insert('berita',$data);
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Berita website koperasi telah diposting. </div>');
			redirect('menu/berita');
		}
		
	}

	public function edit_berita()
	{
		$id = $this->input->post('id');

		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']		 = '2048';
		$config['upload_path']	 = './assets/img/berita/';
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('berkas'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('menu/berita', $error);
		}
		else
		{
			$judul = $this->input->post('judul');
			$tanggal = $this->input->post('tanggal');
			$tag = $this->input->post('tag');
			$author = $this->input->post('author');
			$tulis_artikel = $this->input->post('tulis_artikel');
			$berkas = $this->upload->data('file_name');
			$data = array(
				'judul' => $judul,
				'tanggal' => $tanggal,
				'tag' => $tag,
				'author' => $author,
				'tulis_artikel' => $tulis_artikel,
				'berkas' => $berkas,
			);
			$this->db->set($data);
		}	

		$where = array('id' => $id); 

		$this->load->model('Menu_model');
		$this->Menu_model->editberita($where, $data,'berita');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Berita website koperasi telah diupdate! </div>');
		redirect('menu/berita');
	}

	public function delete_berita($id=null)
	{
		if (!isset($id)) show_404();
		$this->load->model('Menu_model');
		if ($this->Menu_model->deleteberita($id)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Berita website koperasi telah dihapus! </div>');
			redirect(site_url('menu/berita'));
		}
	}
	//END controller berita

}

