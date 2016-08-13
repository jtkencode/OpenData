<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_prodi extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-10 21:17:07
	**/

	function __construct(){
		parent::__construct();
		$this->tb_jurusan = 'jurusan';
		$this->tb_prodi = 'program_studi';
	}

	public function getAllProdi($ord='ASC'){
		$query = $this->db->order_by('ID_PRODI',$ord);
		$query = $this->db->get($this->tb_prodi);
		$query = $query->result_array();

		return $query;
	}

	public function getProdiPer($awal="",$akhir=""){
		$query = $this->db->join($this->tb_jurusan, $this->tb_prodi.'.ID_JURUSAN='.$this->tb_jurusan.'.ID_JURUSAN');
		$query = $this->db->get($this->tb_prodi,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

}