<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-12 22:34:02
	**/

	function __construct(){
		parent::__construct();
		$this->tb_alumni = 'alumni';
		$this->tb_bekerja = 'bekerja';
		$this->tb_perusahaan = 'perusahaan';
	}

	private function outputJson($response=array(),$status=200){
		$this->output
		->set_status_header($status)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($response, JSON_PRETTY_PRINT))
		->_display();
		exit();
	}

	public function ambilSatuPerusahaan($id=0){
		$query = $this->db->get_where($this->tb_perusahaan,array('ID_PERUSAHAAN'=>$id));
		$query = $query->result_array();

		if(!empty($query)){
			$query = $query[0];
		}

		$this->outputJson($query);
	}

}