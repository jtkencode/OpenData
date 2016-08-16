<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_perusahaan extends CI_Model{

	/**
		* Ibnu Ali
	**/

	function __construct(){
		parent::__construct();
		$this->tb_jurusan = 'jurusan';
		$this->tb_perusahaan = 'perusahaan';
    $this->tb_alumni = 'alumni';
	}

	public function getAllPerusahaan($ord='ASC'){
		$query = $this->db->order_by('ID_PERUSAHAAN',$ord);
		$query = $this->db->get($this->tb_perusahaan);
		$query = $query->result_array();

		return $query;
	}

	public function getPerushaanPer($awal="",$akhir=""){
    $query = $this->db->get($this->tb_perusahaan,$awal,$akhir);
        $query = $query->result_array();

        return $query;
	}

	public function getPerusahaan(){
			 $query = $this->db->get($this->tb_perusahaan);
			 if ($query->num_rows() > 0) {
					 return $query->result();
			 }
			 else{
				 false;
			 }
	}

	public function getData($id){
		$this->db->where('ID_PERUSAHAAN',$id);
		$hasil = $this->db->get('perusahaan');

		return $hasil;
	}

	public function get_delete($id){
			$this->db->where('ID_PERUSAHAAN',$id);
			$this->db->delete('perusahaan');
	}

	//insert
		public function get_insert($data){
			$this->db->insert($this->tb_perusahaan,$data);
			redirect('admin/perusahaan');
		}

	//update
		public function get_update($id,$data){
				$this->db->where('ID_PERUSAHAAN',$id);
				$this->db->update('perusahaan',$data);
		}
}
