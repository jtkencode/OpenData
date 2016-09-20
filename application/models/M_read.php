<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_read extends CI_Model{
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
	
	public function getChartPekerjaan($id_jurusan, $angkatan){
		$query = "SELECT a.pekerjaan, COUNT(*) as jumlah3
					FROM alumni a, jurusan j, program_studi p
					WHERE a.tahun_masuk = ? AND j.id_jurusan = ? AND a.id_prodi = p.id_prodi AND p.id_jurusan = j.id_jurusan
					GROUP BY pekerjaan";
			
		$sql = $this->db->query($query, array($angkatan, $id_jurusan));
		return $sql;
	}
	
	public function getJurusan(){
		$query = "SELECT * FROM jurusan ORDER BY ID_JURUSAN";
		$sql = $this->db->query($query);
		return $sql->result();
	}
	
	public function getAngkatan(){
		$query = "SELECT * FROM alumni GROUP BY tahun_masuk ORDER BY tahun_masuk";
		$sql = $this->db->query($query);
		return $sql->result();
	}
}