<?php

class User_m extends CI_Model {

	private $_table = "user";

	public function login($post)
	{
		$query = "SELECT `user`.*, `user_role`.`id`
				 FROM `user`JOIN `user_role`
				 ON `user`.`id` = `user_role`.`id`
				 ";
		return $this->db->query($query)->result_array();
	}

	public function get($id = null)
	{
		$this->db->from('user');
		if($id != null) {
			$this->db->where('user', 'id');

		}
		return $this->db->query($query)->result_array();
	}  


	public function editanggota($data,$id)
	{
		$id = $this->input->post('id');
		$data = array(
			'name'   => $this->input->post('name'),
			'nik'  	 => $this->input->post('nik'),
			'no_hp'  => $this->input->post('no_hp'),
			'alamat' => $this->input->post('alamat')
		);
		$this->db->where('id',$id);
		$this->db->update('user', $data);
		return TRUE;	
	}

	public function editroleuser($data, $id)
	{
		$id = $this->input->post('id');
		$data = array(
			'role_id'  => $this->input->post('role_id')
		);
		$this->db->where('id',$id);
		$this->db->update('user', $data);
		return TRUE;
	}

	public function delete($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }
	

}