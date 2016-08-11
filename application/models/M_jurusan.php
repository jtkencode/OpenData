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

	/* ibnu ali */

	public function getData($id){
		$this->db->where('ID_JURUSAN',$id);
		$hasil = $this->db->get('jurusan');

		return $hasil;
	}
//insert
	public function get_insert($data){
		$data = array('ID_JURUSAN' => $this->input->post('idjurusan'),
									'NAMA_JURUSAN'=>  $this->input->post('namajurusan'),
                 );
            $this->db->insert($this->tb_jurusan,$data);


				redirect('admin/jurusan');
	}

//update
	public function get_update($id,$data){
			$this->db->where('ID_JURUSAN',$id);
			$this->db->update('jurusan',$data);
	}

//delete
public function get_delete($id){
		$this->db->where('ID_JURUSAN',$id);
		$this->db->delete('jurusan');
}


}
