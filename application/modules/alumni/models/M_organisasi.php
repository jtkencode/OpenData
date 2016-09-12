<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_organisasi extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 13:52:20
	**/

	function __construct(){
		parent::__construct();
		$this->tb_organisasi = 'organisasi';
		$this->tb_riwayat = 'riwayat_organisasi';
	}

	public function getAll($where=array()){
		$query = $this->db->order_by('TAHUN_MULAI_JABATAN, TAHUN_SELESAI_JABATAN','DESC');
		$query = $this->db->join($this->tb_organisasi,$this->tb_organisasi.'.ID_ORGANISASI='.$this->tb_riwayat.'.ID_ORGANISASI', 'left');
		$query = $this->db->get_where($this->tb_riwayat,$where);
		$query = $query->result_array();

		return $query;
	}

	public function getAllPer($awal="",$akhir="",$where=array()){
		$query = $this->db->order_by('TAHUN_MULAI_JABATAN, TAHUN_SELESAI_JABATAN','DESC');
		$query = $this->db->join($this->tb_organisasi,$this->tb_organisasi.'.ID_ORGANISASI='.$this->tb_riwayat.'.ID_ORGANISASI', 'left');
		$query = $this->db->where($where);
		$query = $this->db->get($this->tb_riwayat,$awal,$akhir);
		$query = $query->result_array();

		return $query;
	}

	public function getOne($where=array()){
		$query = $this->db->order_by('TAHUN_MULAI_JABATAN, TAHUN_SELESAI_JABATAN','DESC');
		$query = $this->db->join($this->tb_organisasi,$this->tb_organisasi.'.ID_ORGANISASI='.$this->tb_riwayat.'.ID_ORGANISASI', 'left');
		$query = $this->db->get_where($this->tb_riwayat,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function getOrganisasi(){
		$query = $this->db->get($this->tb_organisasi);
		$query = $query->result_array();

		return $query;
	}

	public function insertRiwayat($data=array()){
		$query = $this->db->insert($this->tb_riwayat,$data);
		return $query;
	}

	public function updateRiwayat($id=null,$ubah=array()){
		$query = $this->db->update($this->tb_riwayat, $ubah, array('ID_RIWAYAT_ORGANISASI'=>$id));

		return $query;
	}

	public function deleteRiwayat($where=array()){
		$query = $this->db->delete($this->tb_riwayat,$where);
		return $query;
	}
}