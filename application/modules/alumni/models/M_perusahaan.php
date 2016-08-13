<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_perusahaan extends CI_Model{

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-13 14:44:44
	**/

	function __construct(){
		parent::__construct();
		$this->tb_perusahaan = 'perusahaan';
	}

	public function ambilSemua($order_by="ASC"){
		$query = $this->db->order_by('ID_PERUSAHAAN',$order_by);
		$query = $this->db->get($this->tb_perusahaan);
		$query = $query->result_array();

		return $query;
	}

}