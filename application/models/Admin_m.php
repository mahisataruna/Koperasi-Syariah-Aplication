<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_m extends CI_Model
{
	private $_table = "user_role";

	public function editrole($data, $id)
	{
		$id = $this->input->post('id');
		$data = array(
			'role'  => $this->input->post('role')
		);
		$this->db->where('id',$id);
		$this->db->update('user_role', $data);
		return TRUE;
	}
	public function delete_role($id)
    {
        return $this->db->delete($this->_table, array("id" => $id));
    }

    //model mengambil data simpanan user di detail
    public function getSimpanP($id)
    {
      $query = "SELECT SUM(nominal) 
                  FROM `tb_simpanan` 
                  JOIN `user` 
                  ON `tb_simpanan`.`id`=`user`.`id` 
                  WHERE `user`.`id`='$id' 
                  AND `tb_simpanan`.`jenis_transaksi`='Simpanan Pokok'
    ";
    return $this->db->query($query)->result_array(); 
    }

    public function getSimpanA($id)
    {
    	$query = "SELECT SUM(nominal) 
                  FROM `tb_simpanan` 
                  JOIN `user` 
                  ON `tb_simpanan`.`id`=`user`.`id` 
                  WHERE `user`.`id`='$id' 
                  AND `tb_simpanan`.`jenis_transaksi`='Simpanan Wajib'
		";
		return $this->db->query($query)->result_array();
    }

    //model mengambil data pinjaman user di detail
    public function getPinjamA($id)
    {
    	$query = "SELECT SUM(nominal) 
                  FROM `tb_pinjaman` 
                  JOIN `user` 
                  ON `tb_pinjaman`.`id`=`user`.`id` 
                  WHERE `user`.`id`='$id' 
                  AND `tb_pinjaman`.`status`='0'
		";
		return $this->db->query($query)->result_array();
    }

    //model mengambil data infaq user di detail
    public function getInfaqA($id)
    {
    	$query = "SELECT SUM(nominal) 
                  FROM `tb_infaq` 
                  JOIN `user` 
                  ON `tb_infaq`.`id`=`user`.`id` 
                  WHERE `user`.`id`='$id'
		";
		return $this->db->query($query)->result_array();
    }
}