<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-06 23:12:55
	**/

	function __construct(){
		parent::__construct();
		$this->tb_user = 'user';
		$this->tb_jurusan = 'jurusan';
		$this->tb_prodi = 'program_studi';
	}

	public function auth($info=array()){
		$query = $this->db->get_where($this->tb_user, array('USERNAME'=> $info['username'], 'PASSWORD_USER'=>$info['password']));
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function getAllUser(){
		$query = $this->db->get($this->tb_user);
        $query = $query->result_array();

        return $query;
	}

	public function getAllJurusan(){
		$query = $this->db->get($this->tb_jurusan);
        $query = $query->result_array();

        return $query;
	}

	public function ambilSemuaProdiBy($jurusan_id=0){
		$query = $this->db->get_where($this->tb_prodi,array('ID_JURUSAN'=>$jurusan_id));
		$query = $query->result_array();

		return $query;
	}

	public function getAllUserPer($awal="",$akhir=""){
		$query = $this->db->where_not_in('USERNAME', $this->session->userdata('uname'));
		$query = $this->db->join($this->tb_jurusan, $this->tb_prodi.'.ID_JURUSAN='.$this->tb_jurusan.'.ID_JURUSAN');
		$query = $this->db->join($this->tb_user, $this->tb_prodi.'.ID_PRODI='.$this->tb_user.'.ID_PRODI');
		$query = $this->db->get($this->tb_prodi,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function ambilSatuUser($where){
		$query = $this->db->select("*, ".$this->tb_user.".ID_PRODI as idProdi, ".$this->tb_prodi.".ID_JURUSAN as idJurusan");
		$query = $this->db->join($this->tb_jurusan, $this->tb_prodi.'.ID_JURUSAN='.$this->tb_jurusan.'.ID_JURUSAN');
		$query = $this->db->join($this->tb_user, $this->tb_prodi.'.ID_PRODI='.$this->tb_user.'.ID_PRODI');
		$query = $this->db->get_where($this->tb_prodi,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function ubah($id=null,$ubah=array()){
		$query = $this->db->update($this->tb_user, $ubah, array('ID_USER'=>$id));

		return $query;
	}

	public function tambah($field=array()){
		$query = $this->db->insert($this->tb_user, $field);

		return $query;
	}

}