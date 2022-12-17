<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggota_Transaksi extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('email')){
			redirect('auth');
		}
	}

	public function index() 
	{
		$data['title'] = 'Pengajuan Transaksi';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/index', $data);
		$this->load->view('templates/footer');
	}
	//Controller pengajuan transaksi 
	public function pengajuan_tra()
	{
		if ($_POST['jenis_transaksi']=='Simpanan Pokok') {

			$this->load->model('Transaksi_m');
			$this->Transaksi_m->peng_tambah_simpanan();
			
			$this->_sendEmail(); //kirim email nofikasi kepada admin

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-exclamation-bell fa-sm"></i> Pengajuan simpanan pokok akan segera diproses! </div>');
			redirect('anggota_transaksi/note_buku_simpanan');

		} elseif ($_POST['jenis_transaksi']=='Simpanan Wajib') {
			
			$this->load->model('Transaksi_m');
			$this->Transaksi_m->peng_tambah_simpanan();

			$this->_sendEmail(); //kirim email nofikasi kepada admin
			
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><i class="fas fa-fw fa-exclamation-bell fa-sm"></i> Pengajuan simpanan wajib akan segera diproses! </div>');
			redirect('anggota_transaksi/note_buku_simpanan');

		//Controller cek pinjaman
		} elseif ($_POST['jenis_transaksi']=='Pinjaman') {
			
			$data['user'] = $this->db->get_where('user', ['email' =>
				$this->session->userdata('email')])->row_array();

			$this->load->model('Transaksi_m', 'statusP');
			$pinjam = $this->statusP->getStatusPinjaman($data['user']['id']);

			//query belum solved


		} elseif ($_POST['jenis_transaksi']=='Angsuran') {
			$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert"> 
				Silahkan inputkan pada form berikut. </div>');
			redirect('anggota_transaksi/tampil_form_angsur');

		} elseif ($_POST['jenis_transaksi']=='Infaq') {

			$this->load->model('Transaksi_m');
			$this->Transaksi_m->peng_tambah_infaq();

			$this->_sendEmail(); //kirim email nofikasi kepada admin

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> 
				Pengajuan infaq akan segera diproses! </div>');
			redirect('anggota_transaksi/note_buku_infaq');
		} //elseif ($_POST['jenis_transaksi']=='Penarikan Saldo') {
		 //echo "Ini penarikan saldo";
		//}
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
		$this->email->to('email.aplikasikoperasi@gmail.com');
		$this->email->subject('Pengajuan Transaksi Keuangan');
		$this->email->message('Hallo admin, ada anggota yang telah melakukan pengajuan transaksi. Mohon segera dilakukan pengecekan. Klik: <a href="http://localhost/aplikasikoperasi/auth">disini!</a>');

		if ($this->email->send()) {
			return true;
		} else {
			return false;
		}
	}


	public function tampil_form_angsur()
	{
		$data['title'] = 'Form Angsuran';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'ajukanangsur');
		$data['NoPinjamAgt'] = $this->ajukanangsur->getNoPinjamanAgt($data['user']['id']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/form/form_peng_angsuran', $data);
		$this->load->view('templates/footer');
	}
	//End


	//Controller Buku Simpan
	public function note_buku_simpanan() 
	{
		$data['title'] = 'Status Simpanan Pokok';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/note/note_buku_simpan', $data);
		$this->load->view('templates/footer');
	}

	public function buku_simpanan() 
	{
		$data['title'] = 'Buku Simpanan';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'buku_simpan');
		$data['bukuSimpanAnggota'] = $this->buku_simpan->getBukuSimpananAnggota($data['user']['id']);

		$this->load->model('Transaksi_m', 'buku_simp_wajib');
		$data['bukuSimpanWjbAgt'] = $this->buku_simp_wajib->getBukuSimpWjbAnggota($data['user']['id']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/buku_simpan', $data);
		$this->load->view('templates/footer');
	}
	//End

	//Controller Buku Pinjaman
	public function note_berhasil_pinjam()
	{
		echo "Kamu berlahis";
	}

	public function note_gagal_pinjam()
	{
		$data['title'] = 'Status Simpanan Pokok';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/note/note_transaksi_gagal', $data);
		$this->load->view('templates/footer');
	}

	public function buku_pinjaman() 
	{
		$data['title'] = 'Buku Pinjaman';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'buku_pinjam');
		$data['bukuPinjamAnggota'] = $this->buku_pinjam->getBukuPinjamanAnggota($data['user']['id']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/buku_pinjam', $data);
		$this->load->view('templates/footer');
	}
	//End

	//Controller Buku angsur
	public function buku_angsuran() 
	{
		$data['title'] = 'Buku Angsuran';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'buku_angsur');
		$data['bukuAngsurAnggota'] = $this->buku_angsur->getBukuAngsuranAnggota($data['user']['id']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/buku_angsur', $data);
		$this->load->view('templates/footer');
	}
	//End

	//Controller Buku infaq
	public function note_buku_infaq()
	{
		$data['title'] = 'Status Simpanan Pokok';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/note/note_buku_infaq', $data);
		$this->load->view('templates/footer');	
	}

	public function buku_infaq() 
	{
		$data['title'] = 'Buku Infaq';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();

		$this->load->model('Transaksi_m', 'buku_infaq');
		$data['bukuInfaqAnggota'] = $this->buku_infaq->getBukuInfaqAnggota($data['user']['id']);

		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/buku_infaq', $data);
		$this->load->view('templates/footer');
	}

	public function rincian()
	{
		$data['title'] = 'Rincian Transaksi Terakhir';
		$data['user'] = $this->db->get_where('user', ['email' =>
			$this->session->userdata('email')])->row_array();
		//tambahkan model disini
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('anggota_transaksi/rincian_transaksi', $data);
		$this->load->view('templates/footer');
	}
	//End
}	