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

	/* ibnu ali */
		public function getJurusan(){
				 $query = $this->db->get($this->tb_jurusan);
				 if ($query->num_rows() > 0) {
						 return $query->result();
				 }
				 else{
					 false;
				 }
		}

		public function getData($id){
			$this->db->where('ID_PRODI',$id);
			$hasil = $this->db->get('program_studi');

			return $hasil;
		}
	//insert
		public function get_insert($data){
			$this->db->insert($this->tb_prodi,$data);
			redirect('admin/prodi');
		}

	//update
		public function get_update($id,$data){
				$this->db->where('ID_PRODI',$id);
				$this->db->update('program_studi',$data);
		}

	//delete
	public function get_delete($id){
			$this->db->where('ID_PRODI',$id);
			$this->db->delete('program_studi');
	}

	public function countProdi(){
		$query = $this->db->get($this->tb_prodi);
		$rowcount = $query->num_rows();
	}


}
