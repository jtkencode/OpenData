<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_jurusan extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-07 23:12:39
	**/

	function __construct(){
		parent::__construct();
		$this->tb_jurusan = 'jurusan';
		$this->tb_prodi = 'program_studi';
	}

	public function getAllJurusan($ord='ASC'){
		$query = $this->db->order_by('id_jurusan',$ord);
		$query = $this->db->get($this->tb_jurusan);
		$query = $query->result_array();

		return $query;
	}

	public function getJurusanPer($awal="",$akhir=""){
		$query = $this->db->get($this->tb_jurusan,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

}