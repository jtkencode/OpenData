<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_karya extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 08:56:23
	**/

	function __construct(){
		parent::__construct();
		$this->tb_karya = 'karya_ilmiah';
		$this->tb_membuat = 'membuat_karya_ilmiah';
	}

	public function getAll($where=array()){
		$query = $this->db->order_by('TAHUN_PEMBUATAN','DESC');
		$query = $this->db->join($this->tb_karya,$this->tb_karya.'.ID_KARYA_ILMIAH='.$this->tb_membuat.'.ID_KARYA_ILMIAH', 'left');
		$query = $this->db->get_where($this->tb_membuat,$where);
		$query = $query->result_array();

		return $query;
	}

	public function getAllPer($awal="",$akhir="",$where=array()){
		$query = $this->db->order_by('TAHUN_PEMBUATAN','DESC');
		$query = $this->db->join($this->tb_karya,$this->tb_karya.'.ID_KARYA_ILMIAH='.$this->tb_membuat.'.ID_KARYA_ILMIAH', 'left');
		$query = $this->db->where($where);
		$query = $this->db->get($this->tb_membuat,$awal,$akhir);
		$query = $query->result_array();

		return $query;
	}

	public function getOne($where=array()){
		$query = $this->db->order_by('TAHUN_PEMBUATAN','DESC');
		$query = $this->db->join($this->tb_karya,$this->tb_karya.'.ID_KARYA_ILMIAH='.$this->tb_membuat.'.ID_KARYA_ILMIAH', 'left');
		$query = $this->db->get_where($this->tb_membuat,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function getKarya(){
		$query = $this->db->get($this->tb_karya);
		$query = $query->result_array();

		return $query;
	}

	public function insertRiwayat($data=array()){
		$query = $this->db->insert($this->tb_membuat,$data);
		return $query;
	}

	public function updateRiwayat($id=null,$ubah=array()){
		$query = $this->db->update($this->tb_membuat, $ubah, array('ID_MEMBUAT_KARYA'=>$id));

		return $query;
	}

	public function deleteRiwayat($where=array()){
		$query = $this->db->delete($this->tb_membuat,$where);
		return $query;
	}
}