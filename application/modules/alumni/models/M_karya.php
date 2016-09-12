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

}