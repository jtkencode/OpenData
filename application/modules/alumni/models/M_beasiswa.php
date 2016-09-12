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

}