<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kompetisi extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 16:18:17
	**/

	function __construct(){
		parent::__construct();
		$this->tb_kompetisi = 'kompetisi';
		$this->tb_riwayat = 'riwayat_kompetisi';
	}

	public function getAll($where=array()){
		$query = $this->db->order_by('TAHUN_KOMPETISI','DESC');
		$query = $this->db->join($this->tb_kompetisi,$this->tb_kompetisi.'.ID_KOMPETISI='.$this->tb_riwayat.'.ID_KOMPETISI', 'left');
		$query = $this->db->get_where($this->tb_riwayat,$where);
		$query = $query->result_array();

		return $query;
	}

	public function getAllPer($awal="",$akhir="",$where=array()){
		$query = $this->db->order_by('TAHUN_KOMPETISI','DESC');
		$query = $this->db->join($this->tb_kompetisi,$this->tb_kompetisi.'.ID_KOMPETISI='.$this->tb_riwayat.'.ID_KOMPETISI', 'left');
		$query = $this->db->where($where);
		$query = $this->db->get($this->tb_riwayat,$awal,$akhir);
		$query = $query->result_array();

		return $query;
	}

	public function getOne($where=array()){
		$query = $this->db->order_by('TAHUN_KOMPETISI','DESC');
		$query = $this->db->join($this->tb_kompetisi,$this->tb_kompetisi.'.ID_KOMPETISI='.$this->tb_riwayat.'.ID_KOMPETISI', 'left');
		$query = $this->db->get_where($this->tb_riwayat,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function getKompetisi(){
		$query = $this->db->get($this->tb_kompetisi);
		$query = $query->result_array();

		return $query;
	}

	public function insertRiwayat($data=array()){
		$query = $this->db->insert($this->tb_riwayat,$data);
		return $query;
	}

	public function updateRiwayat($id=null,$ubah=array()){
		$query = $this->db->update($this->tb_riwayat, $ubah, array('ID_RIWAYAT_KOMPETISI'=>$id));

		return $query;
	}

	public function deleteRiwayat($where=array()){
		$query = $this->db->delete($this->tb_riwayat,$where);
		return $query;
	}
}