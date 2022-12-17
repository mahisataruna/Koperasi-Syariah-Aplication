<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model
{
	private $_table = "user_menu";
	private $_table2 = "berita";
	private $_table3 = "gallery";
	private $_table4 = "user_sub_menu";

	//Mulai models Menu
	public function getSubMenu()
	{
		$query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
		FROM `user_sub_menu`JOIN `user_menu`
		ON `user_sub_menu`.`menu_id` = `user_menu`.`id`
		";
		return $this->db->query($query)->result_array();
	}
	public function editsubmenu($id,$data)
	{
		$id = $this->input->post('id');
		$data = array(
			'menu_id' => $this->input->post('menu_id'),
			'title' => $this->input->post('title'),
			'url' => $this->input->post('url'),
			'icon' => $this->input->post('icon'),
			'is_active' => $this->input->post('is_active')
		);
		$this->db->where('id', $id);
		$this->db->update('user_sub_menu', $data);
		return TRUE;
	}

	public function deletesubmenu($id)
	{
		return $this->db->delete($this->_table4, array("id" => $id));	
	}

	public function editmenu($id,$data)
	{
		$id = $this->input->post('id');
		$data = array(
			'menu'  => $this->input->post('menu')
		);
		$this->db->where('id',$id);
		$this->db->update('user_menu', $data);
		return TRUE;
	}

	public function deletemenu($id)
	{
		return $this->db->delete($this->_table, array("id" => $id));
	}
    // END

    //Controller Gallery
    public function editgallery($where, $data, $table3)
    {
    	$id_gallery = $this->input->post('id_gallery');
		$name_foto = $this->input->post('name_foto');
		$tanggal = $this->input->post('tanggal');
		$tag = $this->input->post('tag');
		$author = $this->input->post('author');
		$berkas = $this->upload->data('file_name');
		$data = [
			'name_foto' => $name_foto,
			'tanggal' => $tanggal,
			'tag' => $tag,
			'author' => $author,
			'berkas' => $berkas
		]; 
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update($table3, $data);
    }
    public function deletegallery($id_gallery)
    {
    	return $this->db->delete($this->_table3, array("id_gallery" => $id_gallery));
    }
    //End

    //Mulai models berita
	public function getBerita()
	{
		$this->db->select('*');
		$this->db->from('berita');
		$this->db->order_by('id', 'DESC');
		return $this->db->get()->result();
	}

	public function editberita($where,$data,$table2)
	{	
		$id = $this->input->post('id');
		$judul = $this->input->post('judul');
		$tanggal = $this->input->post('tanggal');
		$tag = $this->input->post('tag');
		$author = $this->input->post('author');
		$tulis_artikel = $this->input->post('tulis_artikel');
		$berkas = $this->upload->data('file_name');
		$data = [
			'judul' => $judul,
			'tanggal' => $tanggal,
			'tag' => $tag,
			'author' => $author,
			'tulis_artikel' => $tulis_artikel,
			'berkas' => $berkas
		]; 
		$this->db->set($data);
		$this->db->where($where);
		$this->db->update($table2, $data);
	}
	public function deleteberita($id)
    {
    	return $this->db->delete($this->_table2, array("id" => $id));
    }

}



