<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Class user transaksi
class Transaksi extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
	}

	public function index() 
	{
		//controller untuk transaksi
		$data['title'] = 'Daftar Pengajuan Transaksi';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'peng');
		$data['ambilPeng'] = $this->peng->getPengajuanAnggota();
		$data['ambilDetail'] = $this->peng->getPengajuanDetail();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/index', $data);
		$this->load->view('templates/footer');
	}

	public function pengajuan_tr()
	{
		if ($_POST[''] == '') {
			echo "Pengajuan berhasil diterima.";
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
				Simpanan berhasil ditambahkan! </div>');
			redirect('transaksi/simpan');
		} elseif ($_POST[''] == '') {
			echo "Pengajuan berhasil diterima.";
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
				Simpanan berhasil ditambahkan! </div>');
		}
		
	}

	//hapus pengajuan anggota
	public function delete_pengajuan($id_transaksi=null)
	{
		if (!isset($id_transaksi)) show_404();
		$this->load->model('Transaksi_m');
		if ($this->Transaksi_m->deletedafpengajuan($id_transaksi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Pengajuan telah ditolak! </div>');
			redirect(site_url('transaksi'));
		}
	}

	//Controller simpanan
	public function simpan() 
	{
		$data['title'] = 'Data Simpanan Anggota';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'simpan');
		$data['simpanAnggota'] = $this->simpan->getSimpananAnggota();
		$data['simpanPokok']= $this->simpan->getSimpananPokokAnggota();
		$data['simpanWajib']= $this->simpan->getSimpananWajibAnggota();
		$this->load->model('Transaksi_m', 'anggota');
		$data['userAnggota'] = $this->anggota->getAnggota();
		// AMBIL DAFTAR NAMA YANG BISA MELAKUKAN SIMPANAN $data['daftarPkagt'] = $this->daftar->getDaftarNamaAgt();
		$data['anggota'] = $this->db->get_where('user', ['role_id'=>2])->result_array();

		$this->form_validation->set_rules('id', 'Id');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('transaksi/simpan', $data);
			$this->load->view('templates/footer');				

		} else {

			$this->load->model('Menu_model');
			$this->Menu_model->tambah_simpanan();
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Simpanan berhasil ditambahkan! </div>');
			redirect('transaksi/simpan');

		}
	}

	public function tambah_simpan($id=null)
	{	
		$this->load->model('Transaksi_m');
		$data = $this->Transaksi_m->getJumSimpananPokokAnggota($id);
		if ($data['nominal'] == 100000) 
		{
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Maaf anggota sudah membayar simpanan pokok. </div>');
			redirect('transaksi/simpan');
		} else {

			$this->load->model('Transaksi_m');
			$this->Transaksi_m->tambah_simpanan();

			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Simpanan berhasil ditambahkan! </div>');
			redirect('transaksi/simpan');
		}
	}

	public function edit_simpananagt()
	{
		$this->load->model('Transaksi_m');
		$this->Transaksi_m->editsimpanAgt($data1, $data2);
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Simpanan berhasil diedit! </div>');
		redirect('transaksi/simpan');
	}

	public function delete_simpanan($id_transaksi=null)
	{

		if (!isset($id_transaksi)) show_404();
		$this->load->model('Transaksi_m');
		if ($this->Transaksi_m->deletesimpanan($id_transaksi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Simpanan telah dihapus! </div>');
			redirect(site_url('transaksi/simpan'));
		}
	}
	//End

	//Controller Pinjaman
	public function pinjam() 
	{
		$data['title'] = 'Data Pinjaman Anggota';
		$data['user'] = $this->db->get_where('user', ['email' => 
			$this->session->userdata('email')])->row_array();
		
		$this->load->model('Transaksi_m', 'infaq');
		$data['PinjamAnggota'] = $this->infaq->getTabelPinjamAnggota();
		$data['pinjam'] = $this->db->get('tb_pinjaman')->result_array();
		$data['anggota'] = $this->db->get_where('user', ['role_id'=>2])->result_array();

		$this->form_validation->set_rules('id_pinjaman', 'Id Pinjaman', 'required');
		$this->form_validation->set_rules('id', 'Id Anggota', 'required');
		$this->form_validation->set_rules('name', 'Name', 'required');

		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header', $data);
			$this->load->view('templates/sidebar', $data);
			$this->load->view('templates/topbar', $data);
			$this->load->view('transaksi/pinjam', $data);
			$this->load->view('templates/footer');				

		} else {
			$data = [

				'name' => $this->input->post('name'),
				'jenis_transaksi' => $this->input->post('jenis_transaksi') 
			];
			$this->db->insert('tb_pinjaman', $data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
				Submenu berhasil ditambahkan! </div>');
			redirect('transaksi/pinjam');

		}
	}

	public function tambah_pinjaman()
	{
		$this->load->model('Transaksi_m');
		$this->Transaksi_m->tambah_pinjaman();
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Pinjaman berhasil ditambahkan! </div>');
		redirect('transaksi/pinjam');
	}

	public function edit_pinjaman()
	{
		$this->load->model('Transaksi_m');
		$this->Transaksi_m->edit_pinjaman($data1, $data2);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Pinjaman telah diedit! </div>');
		redirect('transaksi/pinjam');
	}

	public function delete_pinjaman($id_transaksi=null)
	{
		if (!isset($id_transaksi)) show_404();
		$this->load->model('Transaksi_m');
		if ($this->Transaksi_m->deletepinjaman($id_transaksi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Pinjaman telah dihapus! </div>');
			redirect(site_url('transaksi/pinjam'));
		}
	}
	//End

	//Controller Angsuran
	public function angsuran() 
	{
		$data['title'] = 'Data Angsuran Anggota';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$data['angsuran'] = $this->db->get('tb_angsuran')->result_array(); //Akan diperbarui kembali

		$this->load->model('Transaksi_m', 'tampilAngsur');
		$data['angsurpj'] = $this->tampilAngsur->getTampilA();
		$this->load->model('Transaksi_m', 'angsur');
		$data['NoPinjam'] = $this->angsur->getNoPinjam();

		//$data['anggota'] = $this->db->get_where('user', ['role_id'=>2])->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/angsuran', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_angsuran()
	{
		$this->load->model('Transaksi_m');
		$this->Transaksi_m->tambah_angsur();
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Angsuran berhasil ditambahkan! </div>');
		redirect('transaksi/angsuran');
	}

	public function edit_angsuran()
	{
		$this->load->model('Transaksi_m');
		$this->Transaksi_m->editangsuran($data1, $data2);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Angsuran telah diedit! </div>');
		redirect('transaksi/angsuran');
	}

	public function delete_angsuran($id_transaksi=null)
	{
		if (!isset($id_transaksi)) show_404();
		$this->load->model('Transaksi_m');
		if ($this->Transaksi_m->deleteangsur($id_transaksi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Angsuran telah dihapus! </div>');
			redirect(site_url('transaksi/angsuran'));
		}
	}
	//End

	//Mulai controller Infaq
	public function infaq() 
	{
		$data['title'] = 'Data Infaq Anggota';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'infaq');
		$data['infaqAnggota'] = $this->infaq->getInfaqAnggota();

		$this->load->model('Transaksi_m', 'anggota');
		$data['userAnggota'] = $this->anggota->getAnggota();
		$data['anggota'] = $this->db->get_where('user', ['role_id'=>2])->result_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/infaq', $data);
		$this->load->view('templates/footer');
	}

	public function tambah_infaq()
	{
		$this->load->model('Transaksi_m');
		$this->Transaksi_m->tambah_infaq();
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Infaq berhasil ditambahkan! </div>');
		redirect('transaksi/infaq');
	}

	public function edit_infaq()
	{
		$this->load->model('Transaksi_m');
		$this->Transaksi_m->editinfaq($data1, $data2);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Infaq telah diedit! </div>');
		redirect('transaksi/infaq');
	}

	public function delete_infaq($id_transaksi=null)
	{
		if (!isset($id_transaksi)) show_404();
		$this->load->model('Transaksi_m');
		if ($this->Transaksi_m->deleteinfaq($id_transaksi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Infaq telah dihapus! </div>');
			redirect(site_url('transaksi/infaq'));
		}
	}
	//End

	//Controller Bagi Hasil Usaha
	public function bagihasil() 
	{
		$data['title'] = 'Bagi Hasil Usaha';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'bhu');
		$data['bhuAnggota'] = $this->bhu->getBhuAnggota();

		$this->load->model('Transaksi_m', 'anggota');
		$data['userAnggota'] = $this->anggota->getAnggota();
		$data['anggota'] = $this->db->get_where('user', ['role_id'=>2])->result_array();
		

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('transaksi/bagihasil', $data);
		$this->load->view('templates/footer');
	}
	public function bagihasilagt()
	{
		$data['title'] = 'Bagi Hasil Usaha';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m');
		$this->Transaksi_m->tambah_bagi_hasil();
		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i>Berhasil membagikan hasil! </div>');
		redirect('transaksi/bagihasil');

	}

	public function delete_bhu($id_transaksi=null)
	{
		if (!isset($id_transaksi)) show_404();
		$this->load->model('Transaksi_m');
		if ($this->Transaksi_m->deletebhu($id_transaksi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Bagi hasil telah dihapus! </div>');
			redirect(site_url('transaksi/bagihasil'));
		}
	}
	//End


	//Validasi Pengajuan Transaksi
	Public function validasi()
	{
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$id_transaksi = $this->input->post('id_transaksi');

		$this->db->set('validasi', 1);
		$this->db->where('id_transaksi',$id_transaksi);
		$this->db->update('transaksi');

		$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"><i class="fas fa-fw fa-info fa-sm"></i>Berhasil menyetujui pengajuan! </div>');
		redirect('transaksi');
	}

	public function tolak_pengajuan($id_transaksi=null)
	{
		if (!isset($id_transaksi)) show_404();
		$this->load->model('Transaksi_m');
		if ($this->Transaksi_m->deletetransaksi($id_transaksi)) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><i class="fas fa-fw fa-info fa-sm"></i> Pengajuan telah ditolak! </div>');
			redirect(site_url('transaksi'));
		}
	}
	//End
}	

//End Controller 
//Aplikasi Koperasi Syariah Pada Bundo Saiyo Padang Berbasis Web Mobile