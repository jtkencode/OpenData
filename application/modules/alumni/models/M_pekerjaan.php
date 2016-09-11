<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pekerjaan extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-11 19:04:19
	**/

	function __construct(){
		parent::__construct();
		$this->tb_alumni = 'alumni';
		$this->tb_prodi = 'program_studi';
		$this->tb_jurusan = 'jurusan';
		$this->tb_bekerja = 'bekerja';
		$this->tb_perusahaan = 'perusahaan';
	}

	public function getAll($where=array()){
		$query = $this->db->order_by('TAHUN_MULAI, TAHUN_BERHENTI','DESC');
		$query = $this->db->join($this->tb_perusahaan,$this->tb_perusahaan.'.ID_PERUSAHAAN='.$this->tb_bekerja.'.ID_PERUSAHAAN', 'left');
		$query = $this->db->get_where($this->tb_bekerja,$where);
		$query = $query->result_array();

		return $query;
	}

	public function getAllPer($awal="",$akhir="",$where=array()){
		$query = $this->db->order_by('TAHUN_MULAI, TAHUN_BERHENTI','DESC');
		$query = $this->db->join($this->tb_perusahaan,$this->tb_perusahaan.'.ID_PERUSAHAAN='.$this->tb_bekerja.'.ID_PERUSAHAAN', 'left');
		$query = $this->db->where($where);
		$query = $this->db->get($this->tb_bekerja,$awal,$akhir);
		$query = $query->result_array();

		return $query;
	}

	public function getOne($where=array()){
		$query = $this->db->join($this->tb_perusahaan, $this->tb_perusahaan.'.ID_PERUSAHAAN='.$this->tb_bekerja.'.ID_PERUSAHAAN', 'left');
		$query = $this->db->get_where($this->tb_bekerja,$where);
		$query = $query->result_array();

		if($query){
			return $query[0];
		}
	}

	public function getPerusahaan($order_by="ASC"){
		$query = $this->db->order_by('ID_PERUSAHAAN',$order_by);
		$query = $this->db->where('ID_PERUSAHAAN NOT IN (select ID_PERUSAHAAN from bekerja where ID_ALUMNI='.$this->session->userdata('id').')');
		$query = $this->db->get($this->tb_perusahaan);
		$query = $query->result_array();

		return $query;
	}

	public function insert($data=array()){
		$query = $this->db->insert($this->tb_bekerja,$data);
		return $query;
	}

	public function update($id=null,$ubah=array()){
		$query = $this->db->update($this->tb_bekerja, $ubah, array('ID_BEKERJA'=>$id));

		return $query;
	}

	public function delete($where=array()){
		$query = $this->db->delete($this->tb_bekerja,$where);
		return $query;
	}
}