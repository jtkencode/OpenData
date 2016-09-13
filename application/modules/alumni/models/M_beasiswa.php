<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_beasiswa extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 18:07:40
	**/

	function __construct(){
		parent::__construct();
		$this->tb_beasiswa = 'beasiswa';
		$this->tb_mendapat = 'mendapat_beasiswa';
	}

	public function getAll($where=array()){
		$query = $this->db->order_by('TAHUN_MULAI_BEASISWA','DESC');
		$query = $this->db->join($this->tb_beasiswa,$this->tb_beasiswa.'.ID_BEASISWA='.$this->tb_mendapat.'.ID_BEASISWA', 'left');
		$query = $this->db->get_where($this->tb_mendapat,$where);
		$query = $query->result_array();

		return $query;
	}

	public function getAllPer($awal="",$akhir="",$where=array()){
		$query = $this->db->order_by('TAHUN_MULAI_BEASISWA','DESC');
		$query = $this->db->join($this->tb_beasiswa,$this->tb_beasiswa.'.ID_BEASISWA='.$this->tb_mendapat.'.ID_BEASISWA', 'left');
		$query = $this->db->where($where);
		$query = $this->db->get($this->tb_mendapat,$awal,$akhir);
		$query = $query->result_array();

		return $query;
	}

	public function getOne($where=array()){
		$query = $this->db->order_by('TAHUN_MULAI_BEASISWA','DESC');
		$query = $this->db->join($this->tb_beasiswa,$this->tb_beasiswa.'.ID_BEASISWA='.$this->tb_mendapat.'.ID_BEASISWA', 'left');
		$query = $this->db->get_where($this->tb_mendapat,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function getBeasiswa(){
		$query = $this->db->get($this->tb_beasiswa);
		$query = $query->result_array();

		return $query;
	}

	public function insertRiwayat($data=array()){
		$query = $this->db->insert($this->tb_mendapat,$data);
		return $query;
	}

	public function updateRiwayat($id=null,$ubah=array()){
		$query = $this->db->update($this->tb_mendapat, $ubah, array('ID_MENDAPAT_BEASISWA'=>$id));

		return $query;
	}

	public function deleteRiwayat($where=array()){
		$query = $this->db->delete($this->tb_mendapat,$where);
		return $query;
	}
}