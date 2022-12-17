<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi_m extends CI_Model
{
	private $_table1 = "transaksi";
	private $_table2 = "tb_simpanan";

	//model getAnggota
	public function getAnggota()
	{
		$query = "SELECT `tb_simpanan`.*, `user`.`name`
		FROM `tb_simpanan`JOIN `user`
		ON `tb_simpanan`.`id` = `user`.`id`
		WHERE `user`.`role_id` = 2
		";
		return $this->db->query($query)->result_array();
	}

	//model ambil pengajuan transaksi
	public function getPengajuanAnggota($id=null)
	{
		$query = "SELECT * FROM `transaksi` 
		JOIN `user` 
		ON `user`.`id`= `transaksi`.`id`
		WHERE `transaksi`.`validasi`='0' 
		ORDER BY `transaksi`.`tanggal` DESC
		";
		return $this->db->query($query)->result_array();	
	}

	public function deletedafpengajuan($id_transaksi)
	{
		$query = "DELETE FROM `transaksi` 
				  WHERE `transaksi`.`id_transaksi` = '$id_transaksi'
				 ";
		$this->db->query($query, array($id_transaksi));
		return TRUE;
	}

	public function getPengajuanDetail($id_transaksi=null)
	{
		$query = "SELECT * FROM `transaksi`
		JOIN `user`
		ON `transaksi`.`id` = `user`.`id`
		JOIN `tb_simpanan`
		ON `transaksi`.`id_transaksi` = `tb_simpanan`.`id_transaksi`
		";
		return $this->db->query($query)->result_array();
	}

	public function transaksi()
	{
		//function transaksi
		$query = "SELECT `transaksi`.*, `pinjaman`.`id_transaksi`
		FROM `transaksi` JOIN `pinjaman`
		ON `transaksi`.`id_transaksi` = `pinjaman`.`id_transaksi`
		";
		return $this->db->query($query)->result_array();		  
	}
	public function getAllTransaksi($getAllTransaksi_data=null)
	{
		$query = "SELECT * FROM `transaksi`
		JOIN `user` 
		ON `transaksi`.`id` = `user`.`id`
		WHERE `user`.`id`= '$getAllTransaksi_data'
		AND `transaksi`.`validasi`='1'
		ORDER BY `transaksi`.`tanggal` DESC";
		if ($getAllTransaksi_data!=null) {
			$this->db->where('user.id',$getAllTransaksi_data);
		}

		return $this->db->query($query)->result();
	}

	//Model Buku simpanan anggota
	public function getBukuSimpananAnggota($getBukuSimpananAnggota_data=null)
	{
		$query = "SELECT * FROM `tb_simpanan`
		JOIN `user` 
		ON `tb_simpanan`.`id` = `user`.`id`
		JOIN `transaksi`
		ON `tb_simpanan`.`id_transaksi` = `transaksi`.`id_transaksi`
		AND `tb_simpanan`.`name` = `user`.`name` 
		WHERE `user`.`id`= '$getBukuSimpananAnggota_data'
		AND `transaksi`.`validasi`='1'
		ORDER BY tb_simpanan.tanggal DESC";
		if ($getBukuSimpananAnggota_data!=null) {
			$this->db->where('user.id',$getBukuSimpananAnggota_data);
		}

		return $this->db->query($query)->result();	
	}
	//Ambil simpanan wajib
	public function getBukuSimpWjbAnggota($getBukuSimpWjbAnggota_data=null)
	{
		$query = "SELECT * FROM `tb_simpanan`
		JOIN `user` 
		ON `tb_simpanan`.`id` = `user`.`id`
		JOIN `transaksi`
		ON `tb_simpanan`.`id_transaksi` = `transaksi`.`id_transaksi`
		AND `tb_simpanan`.`name` = `user`.`name` 
		WHERE `user`.`id`= '$getBukuSimpWjbAnggota_data'
		AND `transaksi`.`validasi`='1'
		AND `tb_simpanan`.`jenis_transaksi`='Simpanan Wajib'
		ORDER BY tb_simpanan.tanggal ASC";
		if ($getBukuSimpWjbAnggota_data!=null) {
			$this->db->where('user.id',$getBukuSimpWjbAnggota_data);
		}

		return $this->db->query($query)->result();	
	}

	//Ambil data simpanan dari form simpanan pokok
	public function getJumSimpananPokokAnggota($id)
	{
		$query = "SELECT * FROM `tb_simpanan` 
				  JOIN `user` 
				  ON `user`.`id` = `tb_simpanan`.`id` 
				  WHERE `tb_simpanan`.`id` = '$id'";
		return $this->db->query($query)->result();
	}

	//Model Invoice simpanan
	public function getFakturBukuSimpananAnggota($id_simpanan=null) //Disini belum tampil
	{
		$query = "SELECT * FROM `tb_simpanan`
				  JOIN `transaksi`
				  ON `tb_simpanan`.`id_transaksi` = `transaksi`.`id_transaksi`
				  WHERE `tb_simpanan`.`id_simpanan` = '$id_simpanan'
				  AND `transaksi`.`validasi` = '1'	
				 ";
		return TRUE;		 
	}

	//Mulai model Simpanan
	public function getSimpananAnggota()
	{
		$query = "SELECT * FROM `tb_simpanan`
		JOIN `transaksi`
		ON `transaksi`.`id_transaksi` = `tb_simpanan`.`id_transaksi`
		AND `transaksi`.`jenis_transaksi` = `tb_simpanan`.`jenis_transaksi` 
		WHERE `transaksi`.`validasi`='1'
		ORDER BY `tb_simpanan`.`tanggal` DESC
		";
		return $this->db->query($query)->result_array();		  
	}

	//get simpanan pokok anggota
	public function getSimpananPokokAnggota()
	{
		$query = "SELECT * FROM `tb_simpanan`
				  JOIN `transaksi`
				  ON `transaksi`.`id_transaksi` = `tb_simpanan`.`id_transaksi`
				  AND `transaksi`.`jenis_transaksi` = `tb_simpanan`.`jenis_transaksi`
				  WHERE `transaksi`.`validasi` = '1'
				  AND `tb_simpanan`.`jenis_transaksi` = 'Simpanan Pokok'
				  ORDER BY `transaksi`.`tanggal` DESC
				 ";
		return $this->db->query($query)->result_array();
	}
	//get simpanan wajib anggota
	public function getSimpananWajibAnggota()
	{
		$query = "SELECT * FROM `tb_simpanan`
				  JOIN `transaksi`
				  ON `transaksi`.`id_transaksi` = `tb_simpanan`.`id_transaksi`
				  AND `transaksi`.`jenis_transaksi` = `tb_simpanan`.`jenis_transaksi`
				  WHERE `transaksi`.`validasi` = '1'
				  AND `tb_simpanan`.`jenis_transaksi` = 'Simpanan Wajib'
				  ORDER BY `transaksi`.`tanggal` DESC
				 ";
		return $this->db->query($query)->result_array();		 
	}

	//cetak laporan simpanan pokok dan wajib
	public function getCetakSimpananPokok()
	{

		$query = "SELECT * FROM tb_simpanan 
				  JOIN transaksi 
				  ON transaksi.id_transaksi = tb_simpanan.id_transaksi 
				  AND transaksi.jenis_transaksi = tb_simpanan.jenis_transaksi 
				  WHERE transaksi.validasi = '1' 
				  AND tb_simpanan.jenis_transaksi = 'Simpanan Pokok'  
				  ORDER BY tb_simpanan.tanggal DESC
				 ";
		return $this->db->query($query)->result_array();		 
	}

	public function getCetakSimpananWajib()
	{
		$query = "SELECT * FROM tb_simpanan 
				  JOIN transaksi 
				  ON transaksi.id_transaksi = tb_simpanan.id_transaksi 
				  AND transaksi.jenis_transaksi = tb_simpanan.jenis_transaksi 
				  WHERE transaksi.validasi = '1' 
				  AND tb_simpanan.jenis_transaksi = 'Simpanan Wajib'
				  ORDER BY tb_simpanan.tanggal DESC
				 ";
		return $this->db->query($query)->result_array();		 
	}
	//End

	public function peng_tambah_simpanan()
	{
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 0
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'nominal' => $this->input->post('nominal')
		];
		$this->db->insert('tb_simpanan', $data2);
		$this->db->trans_complete();
		return TRUE;
	}

	public function tambah_simpanan()
	{
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 1
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			
			'nominal' => $this->input->post('nominal')
		];
		$this->db->insert('tb_simpanan', $data2);
		$this->db->trans_complete();
		return $returndata;
	}
	//edit simpanan disini
	public function editsimpanAgt($id_simpanan=null)
	{
		$id_simpanan = $this->input->post('id_simpanan');
		$data = array(
			'id_transaksi'  => $this->input->post('id_transaksi'),
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'nominal' => $this->input->post('nominal')
		);
		$this->db->where('id_simpanan',$id_simpanan);
		$this->db->update('tb_simpanan', $data);
		return TRUE;
	}

	public function getFakturSimpanan($id_simpanan=null)
	{
		$query = "SELECT * FROM `tb_simpanan`
		JOIN `transaksi`
		ON `transaksi`.`id_transaksi` = `tb_simpanan`.`id_transaksi`
		AND `transaksi`.`jenis_transaksi` = `tb_simpanan`.`jenis_transaksi` 
		WHERE `transaksi`.`validasi`='1'
		AND `tb_simpanan`.`id_simpanan` = '$id_simpanan'
		";
		return $this->db->query($query)->result_array();
	}

	public function getDataAgtSimpanan($id_simpanan=null)
	{
		$query = "SELECT * FROM `tb_simpanan`
		JOIN `user`
		ON `tb_simpanan`.`id` = `user`.`id`
		AND `tb_simpanan`.`name` = `user`.`name` 
		WHERE `tb_simpanan`.`id_simpanan` = '$id_simpanan'
		";
		return $this->db->query($query)->result_array();
	}

	public function deletesimpanan($id_transaksi)
	{
		$sql = "DELETE a, b
		FROM tb_simpanan a
		JOIN  transaksi b
		ON a.id_transaksi = b.id_transaksi
		WHERE b.id_transaksi= '$id_transaksi'
		";

		$this->db->query($sql, array($id_transaksi));
		return TRUE;
	}
	//end

	//Mulai model infaq
	public function getBukuInfaqAnggota($getBukuInfaqAnggota_data=null)
	{
		$query = "SELECT * FROM `tb_infaq`
		JOIN `user` 
		ON `tb_infaq`.`id` = `user`.`id`
		JOIN `transaksi`
		ON `tb_infaq`.`id_transaksi` = `transaksi`.`id_transaksi`
		AND `tb_infaq`.`name` = `user`.`name` 
		WHERE `user`.`id`= '$getBukuInfaqAnggota_data'
		AND `transaksi`.`validasi`='1'
		ORDER BY tb_infaq.id_infaq DESC";
		if ($getBukuInfaqAnggota_data!=null) {
			$this->db->where('user.id',$getBukuInfaqAnggota_data);
		}

		return $this->db->query($query)->result();
	}

	public function getAllInfaqAnggota($getAllInfaqAnggota_data=null)
	{
		$query = "SELECT * FROM `tb_infaq`
		JOIN `user` 
		ON `tb_infaq`.`id` = `user`.`id`
		JOIN `transaksi`
		ON `transaksi`.`id_transaksi` = `tb_infaq`.`id_transaksi` 
		WHERE `user`.`id`= '$getAllInfaqAnggota_data'
		AND `transaksi`.`validasi`='1'
		ORDER BY `tb_infaq`.`tanggal` DESC";
		if ($getAllInfaqAnggota!=null) {
			$this->db->where('user.id',$getAllInfaqAnggota);
		}

		return $this->db->query($query)->result();
	}

	public function getInfaqAnggota()
	{
		$query = "SELECT * FROM `tb_infaq`
		JOIN `transaksi`
		ON `transaksi`.`id_transaksi` = `tb_infaq`.`id_transaksi`
		WHERE `transaksi`.`validasi`='1'
		ORDER BY `tb_infaq`.`tanggal` DESC
		";
		return $this->db->query($query)->result_array();		  
	}

	public function peng_tambah_infaq()
	{
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 0
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'nominal' => $this->input->post('nominal')
		];
		$this->db->insert('tb_infaq', $data2);
		$this->db->trans_complete();
		return $returndata;
	}

	public function tambah_infaq()
	{
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 1
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'nominal' => $this->input->post('nominal')
		];
		$this->db->insert('tb_infaq', $data2);
		$this->db->trans_complete();
		return $returndata;
	}
	//controller untuk edit data infaq anggota
	public function editinfaq($id_infaq=null)
	{
		$id_infaq = $this->input->post('id_infaq');
		$data = array(
			'id_transaksi'  => $this->input->post('id_transaksi'),
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'nominal' => $this->input->post('nominal')
		);
		$this->db->where('id_infaq',$id_infaq);
		$this->db->update('tb_infaq', $data);
		return TRUE;
	}
	public function deleteinfaq($id_transaksi)
	{
		$sql = "DELETE a, b
		FROM tb_infaq a
		JOIN  transaksi b
		ON a.id_transaksi = b.id_transaksi
		WHERE b.id_transaksi= '$id_transaksi'
		";

		$this->db->query($sql, array($id_transaksi));
		return TRUE;
	}
	//Faktur infaq masing-masing anggota
	public function getFakturInfaq($id_infaq=null)
	{
		$query = "SELECT * FROM `tb_infaq`
				  JOIN `transaksi`
				  ON `transaksi`.`id_transaksi` = `tb_infaq`.`id_transaksi` 
				  WHERE `transaksi`.`validasi`='1'
				  AND `tb_infaq`.`id_infaq` = '$id_infaq'
				 ";
		return $this->db->query($query)->result();
	}
	//Ambil data anggota 
	public function getDataAgtInfaq($id_infaq=null)
	{
		$query = "SELECT * FROM `tb_infaq`
		JOIN `user`
		ON `tb_infaq`.`id` = `user`.`id`
		AND `tb_infaq`.`name` = `user`.`name` 
		WHERE `tb_infaq`.`id_infaq` = '$id_infaq'
		";
		return $this->db->query($query)->result_array();
	}
	//end

	//Models pinjaman
	public function getAllPinjamAnggota($getAllPinjamAnggota_data=null)
	{
		$query = "SELECT * FROM `tb_pinjaman`
		JOIN `user` 
		ON `tb_pinjaman`.`id` = `user`.`id`
		JOIN `transaksi`
		ON `transaksi`.`id_transaksi` = `tb_pinjaman`.`id_transaksi`

		WHERE `user`.`id`= '$getAllPinjamAnggota_data'
		AND `transaksi`.`validasi`='1'
		ORDER BY `tb_pinjaman`.`tanggal` DESC";
		if ($getAllPinjamAnggota_data!=null) {
			$this->db->where('user.id',$getAllPinjamAnggota_data);
		}

		return $this->db->query($query)->result();
	}

	public function getStatusPinjaman($getStatusPinjaman_data=null)
	{
		$query = "SELECT tb_pinjaman.id_pinjaman, tb_pinjaman.id, tb_pinjaman.name, tb_pinjaman.status
		FROM tb_pinjaman 
		JOIN user
		ON user.id = tb_pinjaman.id
		WHERE user.id = '$getStatusPinjaman_data' 	
		";
		return $this->db->query($query)->result_array();		 
	}

	public function getTabelPinjamAnggota()
	{
		$query = "SELECT * FROM `tb_pinjaman`
		JOIN `transaksi`
		ON `transaksi`.`id_transaksi` = `tb_pinjaman`.`id_transaksi`
		WHERE `transaksi`.`validasi`='1'
		ORDER BY `tb_pinjaman`.`tanggal` DESC
		";
		return $this->db->query($query)->result_array();
	}
	public function tambah_pinjaman()
	{
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 1
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'tanggal' => $this->input->post('tanggal'),
			'nominal' => $this->input->post('nominal'),
			'lama_pinjam' => $this->input->post('lama_pinjam'),
			'status' => 0
		];
		$this->db->insert('tb_pinjaman', $data2);
		$this->db->trans_complete();
		return TRUE;
	}

	public function edit_pinjaman($id_pinjaman=null)
	{
		$id_pinjaman = $this->input->post('id_pinjaman');
		$data = array(
			'id_transaksi'  => $this->input->post('id_transaksi'),
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'nominal' => $this->input->post('nominal'),
			'status' => $this->input->post('status')

		);
		$this->db->where('id_pinjaman',$id_pinjaman);
		$this->db->update('tb_pinjaman', $data);
		return TRUE;
	}

	public function peng_tambah_pinjaman()
	{
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 0
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'tanggal' => $this->input->post('tanggal'),
			'nominal' => $this->input->post('nominal'),
			'status' => 0
		];
		$this->db->insert('tb_infaq', $data2);
		$this->db->trans_complete();
		return $returndata;
	}

	public function getBukuPinjamanAnggota($getBukupinjamanAnggota_data=null)
	{
		$query = "SELECT * FROM `tb_pinjaman` 
		JOIN `user` 
		ON `tb_pinjaman`.`id` = `user`.`id` 
		AND `tb_pinjaman`.`name` = `user`.`name` 
		WHERE `user`.`id`= '$getBukupinjamanAnggota_data'
		ORDER BY tb_pinjaman.id_pinjaman DESC";
		if ($getBukupinjamanAnggota_data!=null) {
			$this->db->where('user.id',$getBukupinjamanAnggota_data);
		}

		return $this->db->query($query)->result();	
	}


	public function getPinjamAnggota()
	{
		$query = "SELECT tb_pinjaman.id_transaksi, tb_pinjaman.id_pinjaman, tb_pinjaman.id,tb_pinjaman.name, tb_pinjaman.tanggal_pinjam,tb_pinjaman.nominal
		FROM tb_pinjaman 
		JOIN transaksi 
		ON transaksi.id_transaksi = tb_pinjaman.id_transaksi 
		JOIN user  
		ON tb_pinjaman.id = user.id
		";
		return $this->db->query($query)->result_array();
	}

	//Faktur Pinjaman masing-masing anggota
	public function getFakturPinjam($id_pinjaman=null)
	{
		$query = "SELECT * FROM `tb_pinjaman`
				  JOIN `transaksi`
				  ON `transaksi`.`id_transaksi` = `tb_pinjaman`.`id_transaksi`
				  AND `transaksi`.`jenis_transaksi` = `tb_pinjaman`.`jenis_transaksi` 
				  WHERE `transaksi`.`validasi`='1'
				  AND `tb_pinjaman`.`id_pinjaman` = '$id_pinjaman'
				 ";
		return $this->db->query($query)->result();
	}
	//Ambil data anggota dari pinjaman 
	public function getDataAgtPinjaman($id_pinjaman)
	{
		$query = "SELECT * FROM `tb_pinjaman`
				  JOIN `user`
				  ON `tb_pinjaman`.`id` = `user`.`id`
				  AND `tb_pinjaman`.`name` = `user`.`name` 
				  WHERE `tb_pinjaman`.`id_pinjaman` = '$id_pinjaman'
				 ";
		return $this->db->query($query)->result();
	}

	public function deletepinjaman($id_transaksi)
	{
		$sql = "DELETE a, b
		FROM tb_pinjaman a
		JOIN  transaksi b
		ON a.id_transaksi = b.id_transaksi
		WHERE b.id_transaksi= '$id_transaksi'
		";

		$this->db->query($sql, array($id_transaksi));
		return TRUE;
	}
	//end

	//model angsuran
	public function getBukuAngsuranAnggota($getBukuAngsuranAnggota_data=null)
	{
		$query = "SELECT * FROM `tb_angsuran` 
		JOIN `user` 
		ON `tb_angsuran`.`id` = `user`.`id` 
		AND `tb_angsuran`.`name` = `user`.`name` 
		WHERE `user`.`id`= '$getBukuAngsuranAnggota_data'
		ORDER BY tb_angsuran.id_angsuran DESC";
		if ($getBukuAngsuranAnggota_data!=null) {
			$this->db->where('user.id',$getBukuAngsuranAnggota_data);
		}

		return $this->db->query($query)->result();
	}
	//ambil data pinjaman 
	public function getNoPinjam()
	{
		$query = "SELECT tb_pinjaman.id_pinjaman, tb_pinjaman.id, tb_pinjaman.name 
		FROM tb_pinjaman 
		WHERE tb_pinjaman.status = '0'
		";
		return $this->db->query($query)->result_array();
	}

	public function getNoPinjamanAgt($getNoPinjamanAgt_data=null)
	{
		$query = "SELECT tb_pinjaman.id_pinjaman, tb_pinjaman.id, tb_pinjaman.name, tb_pinjaman.status
		FROM tb_pinjaman 
		JOIN user
		ON user.id = tb_pinjaman.id
		WHERE tb_pinjaman.status = '0'
		AND user.id = '$getNoPinjamanAgt_data'
		";
		return $this->db->query($query)->result_array();	
	}
	//tampil seleuruh angsur
	public function getTampilA()
	{
		$query = "SELECT * FROM tb_angsuran
				  JOIN tb_pinjaman
				  ON tb_angsuran.id_pinjaman = tb_pinjaman.id_pinjaman
				 ";
		return $this->db->query($query)->result_array();		 
	}

	//tambah angsur masih perlu perbaikan
	public function tambah_angsur()
	{
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => $this->input->post('jenis_transaksi'),
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 1
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id_pinjaman'=> $this->input->post('id_pinjaman'),
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'angsuran_ke' => $this->input->post('angsuran_ke'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah_angsuran' => $this->input->post('jumlah_angsuran'),
			'sisa_pinjam' => 10 //Logika sisi pinjaman = jumlah pinjam - jumlah angsuran
		];
		$this->db->insert('tb_angsuran', $data2);
		$this->db->trans_complete();
		return $returndata;
	}
	public function editangsuran($id_angsuran=null)
	{
		$id_angsuran = $this->input->post('id_angsuran');
		$data = array(
			'id_transaksi'  => $this->input->post('id_transaksi'),
			'id_pinjaman' => $this->input->post('id_pinjaman'),
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'angsuran_ke' => $this->input->post('angsuran_ke'),
			'tanggal' => $this->input->post('tanggal'),
			'jumlah_angsuran' => $this->input->post('jumlah_angsuran')
		);
		$this->db->where('id_angsuran',$id_angsuran);
		$this->db->update('tb_angsuran', $data);
		return TRUE;
	}
	//ambil data angsuran masing-masing
	public function getFakturAngsuranAgt($id_angsuran=null)
	{
		$query = "SELECT * FROM `tb_angsuran`
				  JOIN `transaksi`
				  ON `transaksi`.`id_transaksi` = `tb_angsuran`.`id_transaksi` 
				  WHERE `transaksi`.`validasi`='1'
				  AND `tb_angsuran`.`id_angsuran` = '$id_angsuran'
				 ";
		return $this->db->query($query)->result();
	}
	//Ambil data anggota angsuran
	public function getDataAgtAngsur($id_angsuran=null)
	{
		$query = "SELECT * FROM `tb_angsuran`
		JOIN `user`
		ON `tb_angsuran`.`id` = `user`.`id`
		AND `tb_angsuran`.`name` = `user`.`name` 
		WHERE `tb_angsuran`.`id_angsuran` = '$id_angsuran'
		";
		return $this->db->query($query)->result_array();
	}

	public function deleteangsur($id_transaksi)
	{
		$sql = "DELETE a, b
		FROM tb_angsuran a
		JOIN  transaksi b
		ON a.id_transaksi = b.id_transaksi
		WHERE b.id_transaksi= '$id_transaksi'
		";

		$this->db->query($sql, array($id_transaksi));
		return TRUE;
	}

	//end

	//Bagi hasil model disini dan masih perlu perbaikan
	public function tambah_bagi_hasil($id=null)
	{	
		$this->db->trans_start();
		$data1 = [
			'jenis_transaksi' => 'Bagi Hasil Usaha',
			'id' => $this->input->post('id'),
			'tanggal' => $this->input->post('tanggal'),
			'validasi' => 1
		];
		$this->db->insert('transaksi', $data1);
		$last_id = $this->db->insert_id(); 
		$data2 = [
			'id_transaksi' => $last_id,
			'id_bhu' => $this->input->post('id_bhu'),
			'id' => $this->input->post('id'),
			'name' => $this->input->post('name'),
			'tanggal' => $this->input->post('tanggal'),
			'nominal' => (10/100)*10000 //ini masih perlu diperbaiki
		];
		$this->db->insert('tb_bagi_hasil', $data2);
		$this->db->trans_complete();
		return TRUE;
	}

	public function getBhuAnggota()
	{
		$query = "SELECT tb_bagi_hasil.id_bhu, tb_bagi_hasil.id_transaksi, tb_bagi_hasil.id, tb_bagi_hasil.name, tb_bagi_hasil.tanggal, tb_bagi_hasil.nominal
		FROM tb_bagi_hasil
		INNER JOIN transaksi
		ON tb_bagi_hasil.id_transaksi = transaksi.id_transaksi
		AND tb_bagi_hasil.tanggal = transaksi.tanggal
		ORDER BY tb_bagi_hasil.id_bhu DESC";
		return $this->db->query($query)->result_array();	
	}
	//cetak faktur masing masing-masing anggota
	public function getFakturBhu($id_bhu=null)
	{
		$query = "SELECT * FROM `tb_bagi_hasil`
		JOIN `transaksi`
		ON `transaksi`.`id_transaksi` = `tb_bagi_hasil`.`id_transaksi`
		WHERE `transaksi`.`validasi`='1'
		AND `tb_bagi_hasil`.`id_bhu` = '$id_bhu'
		";
		return $this->db->query($query)->result_array();
	}
	public function getDataAgtBhu($id_bhu)
	{
		$query = "SELECT * FROM `tb_bagi_hasil`
		JOIN `user`
		ON `tb_bagi_hasil`.`id` = `user`.`id`
		AND `tb_bagi_hasil`.`name` = `user`.`name` 
		WHERE `tb_bagi_hasil`.`id_bhu` = '$id_bhu'
		";
		return $this->db->query($query)->result_array();
	}

	public function deletebhu($id_transaksi)
	{
		$sql = "DELETE a, b
		FROM tb_bagi_hasil a
		JOIN  transaksi b
		ON a.id_transaksi = b.id_transaksi
		WHERE b.id_transaksi= '$id_transaksi'
		";

		$this->db->query($sql, array($id_transaksi));
		return TRUE;
	}
	//end
}
//End Models Transaksi
//Aplikasi Koperasi Syariah Pada Bundo Saiyo Padang Berbasis Web Mobile