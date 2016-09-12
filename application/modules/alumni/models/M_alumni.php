<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_alumni extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-11 20:09:55
	**/

	function __construct(){
		parent::__construct();
		$this->tb_alumni = 'alumni';
		$this->tb_prodi = 'program_studi';
		$this->tb_jurusan = 'jurusan';
		$this->tb_bekerja = 'bekerja';
		$this->tb_perusahaan = 'perusahaan';
		$this->tb_ta = 'tugas_akhir';
	}

	public function auth($info=array()){
		$query = $this->db->get_where($this->tb_alumni,array('USERNAME'=>$info['username'], 'PASSWORD'=> $info['password']));
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function ubah($id=null,$ubah=array()){
		$query = $this->db->update($this->tb_alumni, $ubah, array('ID_ALUMNI'=>$id));

		return $query;
	}

	public function ambilSatu($info=array()){
		$query = $this->db->select("*, ".$this->tb_alumni.".ID_PRODI as idProdi, ".$this->tb_prodi.".ID_JURUSAN as idJurusan, ".$this->tb_alumni.".ID_TUGAS_AKHIR as idTA");
		$query = $this->db->join($this->tb_jurusan,$this->tb_jurusan.'.ID_JURUSAN='.$this->tb_prodi.'.ID_JURUSAN');
		$query = $this->db->join($this->tb_alumni,$this->tb_prodi.'.ID_PRODI='.$this->tb_alumni.'.ID_PRODI');
		$query = $this->db->join($this->tb_ta,$this->tb_ta.'.ID_TUGAS_AKHIR='.$this->tb_alumni.'.ID_TUGAS_AKHIR');
		$query = $this->db->get_where($this->tb_prodi,$info);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function ambilHistoriPekerjaan($where=array()){
		$query = $this->db->order_by('TAHUN_MULAI, TAHUN_BERHENTI','DESC');
		$query = $this->db->join($this->tb_perusahaan,$this->tb_perusahaan.'.ID_PERUSAHAAN='.$this->tb_bekerja.'.ID_PERUSAHAAN');
		$query = $this->db->get_where($this->tb_bekerja,$where);
		$query = $query->result_array();

		return $query;
	}

	public function ambilSatuProdi($where=array()){
		$query = $this->db->get_where($this->tb_prodi,$where);
		$query = $query->result_array();

		if($query){
			return $query[0];
		}
	}

	public function ambilSemuaProdiBy($jurusan_id=0){
		$query = $this->db->get_where($this->tb_prodi,array('ID_JURUSAN'=>$jurusan_id));
		$query = $query->result_array();

		return $query;
	}

	public function ambilSemuaJurusan(){
		$query = $this->db->get($this->tb_jurusan);
		$query = $query->result_array();

		return $query;
	}

	public function ambilTA(){
		$query = $this->db->get($this->tb_ta);
		$query = $query->result_array();

		return $query;
	}
}