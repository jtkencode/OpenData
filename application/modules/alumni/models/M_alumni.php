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
		$this->tb_bekerja = 'bekerja';
		$this->tb_perusahaan = 'perusahaan';
	}

	public function auth($info=array()){
		$query = $this->db->get_where($this->tb_alumni,array('USERNAME'=>$info['username'], 'PASSWORD'=> $info['password']));
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function ambilSatu($info=array()){
		$query = $this->db->get_where($this->tb_alumni,$info);
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

}