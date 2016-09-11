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
		$this->tb_prodi = 'program_studi';
		$this->tb_jurusan = 'jurusan';
		$this->tb_bekerja = 'bekerja';
		$this->tb_perusahaan = 'perusahaan';
		$this->tb_user = 'user';
		$this->tb_TA = 'tugas_akhir';
	}

	private function outputJson($response=array(),$status=200){
		$this->output
		->set_status_header($status)
		->set_content_type('application/json', 'utf-8')
		->set_output(json_encode($response, JSON_PRETTY_PRINT))
		->_display();
		exit();
	}

	public function ambilSatuUser($id=0){
		$query = $this->db->join($this->tb_jurusan, $this->tb_prodi.'.ID_JURUSAN='.$this->tb_jurusan.'.ID_JURUSAN');
		$query = $this->db->join($this->tb_user, $this->tb_prodi.'.ID_PRODI='.$this->tb_user.'.ID_PRODI');
		$query = $this->db->get_where($this->tb_prodi,array('ID_USER'=>$id));
		$query = $query->result_array();

		if(!empty($query)){
			$query = $query[0];
		}

		$this->outputJson($query);
	}

	public function ambilSatuPerusahaan($id=0){
		$query = $this->db->get_where($this->tb_perusahaan,array('ID_PERUSAHAAN'=>$id));
		$query = $query->result_array();

		if(!empty($query)){
			$query = $query[0];
		}

		$this->outputJson($query);
	}

	public function ambilSatuPekerjaan($id=0){
		$query = $this->db->get_where($this->tb_bekerja,array('ID_BEKERJA'=>$id));
		$query = $query->result_array();

		if(!empty($query)){
			$query = $query[0];
		}

		$this->outputJson($query);
	}

	public function tambahPekerjaan(){
		$response = array('status'=>false, 'message'=>null, 'id'=> 0);

		@$user_id=$this->session->userdata('id');
		@$id_perusahaan = $this->input->post('id_perusahaan');
		@$jabatan = $this->input->post('jabatan');
		@$thn_mulai = $this->input->post('thn_mulai');
		@$thn_berhenti = $this->input->post('thn_berhenti');

		if(!empty($jabatan)){
			$data = array(
				'ID_ALUMNI'			=> $user_id,
				'ID_PERUSAHAAN'		=> $id_perusahaan,
				'JABATAN_PEKERJAAN'	=> strip_tags($jabatan),
				'TAHUN_MULAI'		=> $thn_mulai,
				'TAHUN_BERHENTI'	=> $thn_berhenti,
			);

			$insert = $this->db->insert($this->tb_bekerja,$data);
			$last_id = $this->db->insert_id();

			if($insert){
				$response = array('status'=>true, 'message'=>'Berhasil menambah pekerjaan.', 'id'=> $last_id);
			}else{
				$response = array('status'=>false, 'message'=>'Kesalahan database', 'id'=> 0);
			}
		}

		$this->outputJson($response);
	}

	public function ubahPekerjaan(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');
		@$id_perusahaan = $this->input->post('id_perusahaan');
		@$jabatan = $this->input->post('jabatan');
		@$thn_mulai = $this->input->post('thn_mulai');
		@$thn_berhenti = $this->input->post('thn_berhenti');

		if(!empty($id)){
			$data = array(
				'ID_PERUSAHAAN'		=> $id_perusahaan,
				'JABATAN_PEKERJAAN'	=> strip_tags($jabatan),
				'TAHUN_MULAI'		=> $thn_mulai,
				'TAHUN_BERHENTI'	=> $thn_berhenti,
			);

			$cekKerja = $this->db->get_where($this->tb_bekerja,array(
				'ID_ALUMNI' => $this->session->userdata('id'),
				'ID_PERUSAHAAN' => $id_perusahaan,
				'TAHUN_MULAI' => $thn_mulai,
				'TAHUN_BERHENTI' => $thn_berhenti
			))->result_array();

			@$idna = $cekKerja[0]['ID_BEKERJA'];

			if(empty($cekKerja) || $idna==$id){
				$edit = $this->db->where('ID_BEKERJA', $id);
				$edit = $this->db->update($this->tb_bekerja,$data);

				if($edit){
					$response = array('status'=>true, 'message'=>'Berhasil membuat perubahan pada pekerjaan.');
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database');
				}
			}else{
				$response = array('status'=>false, 'message'=>'Data sudah ada pada periode kerja di perusahaan tersebut.');
			}
		}

		$this->outputJson($response);
	}

	public function hapusPekerjaan(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			$cekKerja = $this->db->join($this->tb_perusahaan,$this->tb_perusahaan.'.ID_PERUSAHAAN='.$this->tb_bekerja.'.ID_PERUSAHAAN');
			$cekKerja = $this->db->get_where($this->tb_bekerja,array('ID_BEKERJA' => $id))->result_array();

			if(!empty($cekKerja)){
				$hapus = $this->db->delete($this->tb_bekerja,array('ID_BEKERJA' => $id));

				if($hapus){
					$response = array('status'=>true, 'message'=>'Berhasil menghapus pekerjaan di perusahaan '.$cekKerja[0]['NAMA_PERUSAHAAN'].'.');
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database');
				}
			}
		}

		$this->outputJson($response);
	}

	public function hapusUser(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			$cekUser = $this->db->get_where($this->tb_user,array('ID_USER' => $id))->result_array();

			if(!empty($cekUser)){
				$hapus = $this->db->delete($this->tb_user,array('ID_USER' => $id));

				if($hapus){
					$response = array('status'=>true, 'message'=>'Berhasil menghapus pengguna.');
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database');
				}
			}
		}

		$this->outputJson($response);
	}

	public function getProdi(){
		@$id = $this->input->get('id');

		if(!empty($id)){
			$prodi = $this->db->get_where($this->tb_prodi,array('ID_JURUSAN'=>$id));
			$prodi = $prodi->result_array();

			echo "<select name=\"prodi\" class=\"form-control\">";
			foreach ($prodi as $p){
				echo "<option value='".$p['ID_PRODI']."'>".$p['NAMA_PRODI']."</option>";
			}
			echo "</select>";
		}
	}

	public function searchPerusahaan(){
		$datana['suggestions']=array();
		// tangkap variabel keyword dari URL
		$keyword = $this->uri->segment(3);
		// cari di database
		$data = $this->db->like('NAMA_PERUSAHAAN',$keyword)->get($this->tb_perusahaan)->result_array();

		foreach ($data as $data) {
			$datana['suggestions'][] = array(
				'value'	=>$data['NAMA_PERUSAHAAN'],
				'id'	=>$data['ID_PERUSAHAAN'],
				'email'	=>$data['EMAIL_PERUSAHAAN']
			);
		}


		$this->outputJson($datana);
	}

	public function ambilSatuAlumni($id=0){

		if(!empty($id)){
			$data = array();

			//tugas akhir
			$dataTA= $this->db->join($this->tb_alumni, $this->tb_TA.'.ID_TUGAS_AKHIR='.$this->tb_alumni.'.ID_TUGAS_AKHIR');
			$dataTA = $this->db->get_where($this->tb_TA,array('ID_ALUMNI'=>$id))->result_array();

			$dataAlumni = $this->db->join($this->tb_jurusan, $this->tb_prodi.'.ID_JURUSAN='.$this->tb_jurusan.'.ID_JURUSAN');
			$dataAlumni = $this->db->join($this->tb_alumni, $this->tb_prodi.'.ID_PRODI='.$this->tb_alumni.'.ID_PRODI');
			$dataAlumni = $this->db->get_where($this->tb_prodi,array('ID_ALUMNI'=>$id))->result_array();

			if(!empty($dataAlumni)){
				$riwayatKerja = $this->db->order_by('TAHUN_MULAI, TAHUN_BERHENTI','DESC');
				$riwayatKerja = $this->db->join($this->tb_perusahaan,$this->tb_perusahaan.'.ID_PERUSAHAAN='.$this->tb_bekerja.'.ID_PERUSAHAAN');
				$riwayatKerja = $this->db->get_where($this->tb_bekerja,['ID_ALUMNI'=>$id])->result_array();

				$foto = (!empty($dataAlumni[0]['FOTO'])) ? base_url('assets/'.$dataAlumni[0]['FOTO']) : base_url('assets/upload/alumni/default.png');
				$data = array(
					'id_alumni'		=> $id,
					'foto'			=> $foto,
					'nama_alumni'	=> $dataAlumni[0]['NAMA_ALUMNI'],
					'email_alumni'	=> $dataAlumni[0]['EMAIL_ALUMNI'],
					'alamat_alumni'	=> $dataAlumni[0]['ALAMAT_ALUMNI'],
					'no_hp'			=> $dataAlumni[0]['NO_HP'],
					'jurusan'		=> $dataAlumni[0]['NAMA_JURUSAN'],
					'prodi'			=> $dataAlumni[0]['NAMA_PRODI'],
					'thn_masuk'		=> $dataAlumni[0]['TAHUN_MASUK'],
					'thn_keluar'	=> $dataAlumni[0]['TAHUN_KELUAR'],
					'tugasAkhir'	=> $dataTA[0]['JUDUL_TUGAS_AKHIR'],
					'pekerjaan'		=> $dataAlumni[0]['PEKERJAAN'],
					'riwayatKerja'=> $riwayatKerja
				);
			}
			$this->outputJson($data);
		}
	}
}
