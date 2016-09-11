<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_alumni extends CI_Model{

	/**
		* Ibnu Ali
	**/

	function __construct(){
		parent::__construct();
		$this->tb_jurusan = 'jurusan';
		$this->tb_prodi = 'program_studi';
    $this->tb_alumni = 'alumni';
	}

	public function getAllAlumni($ord='ASC'){
		$query = $this->db->order_by('id_alumni',$ord);
		$query = $this->db->get($this->tb_alumni);
		$query = $query->result_array();

		return $query;
	}

	public function getAlumniPer($awal="",$akhir=""){
		$query = $this->db->join($this->tb_prodi, $this->tb_alumni.'.ID_PRODI='.$this->tb_prodi.'.ID_PRODI');
		$query = $this->db->get($this->tb_alumni,$awal,$akhir);
        $query = $query->result_array();
        return $query;
	}

	public function getProdi(){
		
			 $query = $this->db->get($this->tb_prodi);
			 if ($query->num_rows() > 0) {
					 return $query->result();
			 }
			 else{
				 false;
			 }
	}

	public function getData($id){
		$this->db->where('ID_ALUMNI',$id);
		$hasil = $this->db->get('alumni');

		return $hasil;
	}

	public function get_delete($id){
			$this->db->where('ID_ALUMNI',$id);
			$this->db->delete('alumni');
	}

	//insert
		public function get_insert($data){

			$this->db->insert($this->tb_alumni,$data);
			redirect('master/alumni');
		}

	//update
		public function get_update($id,$data){
				$this->db->where('ID_ALUMNI',$id);
				$this->db->update('alumni',$data);
		}


}
