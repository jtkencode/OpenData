<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mread extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
     
    public function getChartData_Angkatan(){	
		$query = $this->db->query('SELECT *, COUNT(*) as jumlah FROM alumni GROUP BY TAHUN_MASUK');
		return $query;
    }
	
	public function getChartData_Jurusan(){
		$query = "SELECT *, COUNT(*) as jumlah2 FROM alumni
				  INNER JOIN program_studi ON alumni.ID_PRODI = program_studi.ID_PRODI 
				  INNER JOIN jurusan ON program_studi.ID_JURUSAN = jurusan.ID_JURUSAN
				  GROUP BY program_studi.ID_JURUSAN";
		$sql = $this->db->query($query);
		return $sql;
    }
	
	public function getJurusanAlumni(){
		$query = "SELECT * FROM alumni 
				  INNER JOIN program_studi ON alumni.ID_PRODI = program_studi.ID_PRODI 
				  INNER JOIN jurusan ON program_studi.ID_JURUSAN = jurusan.ID_JURUSAN
				  GROUP BY program_studi.ID_JURUSAN";
		
		$sql = $this->db->query($query);
		return $sql->result();
	}
}