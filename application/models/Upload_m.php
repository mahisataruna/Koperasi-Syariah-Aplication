<?php

class Upload_m extends CI_Model {

	private $_table = "upload";

	public $id_berkas;
	public $name_berkas;
	public $keterangan;
	public $tanggal;
	public $berkas = "Informasi.pdf";

	public function rules()
	{
		return [
			['field' => 'name_berkas',
			'label' => 'Name Berkas',
			'rules' => 'required'],

			['field' => 'keterangan',
			'label' => 'Keterangan',
			'rules' => 'required'],

			['field' => 'tanggal',
			'label' => 'Tanggal',
			'rules' => 'required'],

		];
	} 

	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}   

	public function getById($id)
	{
		return $this->db->get_where($this->_table, ["id_berkas" => $id])->row();
	}

	public function save()
	{
		$post = $this->input->post();
		$this->id_berkas = uniqid();
		$this->name_berkas = $post["name_berkas"];
		$this->keterangan = $post["keterangan"];
		$this->tanggal = $post["tanggal"];
		$this->berkas = $post["berkas"];
		return $this->db-insert($this->_table, $this);
	}

	public function update()
	{
		$post = $this->input->post();
		$this->name_berkas = $post['name_berkas'];
		$this->keterangan = $post['keterangan'];
		$this->tanggal = $post['tanggal'];
		$this->berkas = $post['berkas'];
		return $this->db->update($this->_table, $this, array('id_berkas' => $post['id']));
	}

	public function getInformasi()
	{
		$this->db->select('*');
		$this->db->from('upload');
		$this->db->order_by('id_berkas', 'DESC');
		return $this->db->get()->result();
	}

	public function editinformasi($where,$data,$table)
	{	
		$id_berkas = $this->input->post('id_berkas');
		$name_berkas = $this->input->post('name_berkas');
		$keterangan = $this->input->post('keterangan');
		$tanggal = $this->input->post('tanggal');
		$berkas = $this->upload->data('file_name');
		$data = [
			'name_berkas' => $name_berkas,
			'keterangan' => $keterangan,
			'tanggal' => $tanggal,
			'berkas' => $berkas,
		]; 
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update($table, $data);
	}

	
	public function delete($id_berkas)
	{
		return $this->db->delete($this->_table, array("id_berkas" => $id_berkas));
	}
}
