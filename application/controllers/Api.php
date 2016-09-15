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
		$this->tb_organisasi = 'organisasi';
		$this->tb_riwayat_org = 'riwayat_organisasi';
		$this->tb_kompetisi = 'kompetisi';
		$this->tb_riwayat_komp = 'riwayat_kompetisi';
		$this->tb_karya = 'karya_ilmiah';
		$this->tb_membuat_karya = 'membuat_karya_ilmiah';
		$this->tb_beasiswa = 'beasiswa';
		$this->tb_mendapat = 'mendapat_beasiswa';
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

	public function tambahPerusahaan(){
		$this->load->library('form_validation');

		$response = array('status'=>false, 'message'=>null, 'id'=> 0);

		$this->form_validation->set_rules('nama', 'Nama Perusahaan', 'required|min_length[3]|max_length[20]|is_unique[perusahaan.NAMA_PERUSAHAAN]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('notelp', 'Telp Perusahaan', 'alpha_numeric|required|min_length[5]|max_length[12]|is_unique[perusahaan.NOMOR_TELEPON_PERUSAHAAN]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('alamat', 'Alamat Perusahaan', 'required|min_length[5]|max_length[255]', array(
			'required'	=> 'You have not provided %s.'
        ));
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|min_length[3]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));
        $this->form_validation->set_rules('bidang', 'Bidang Perusahaan', 'required|min_length[5]|max_length[60]', array(
			'required'	=> 'You have not provided %s.'
        ));

		if($this->form_validation->run()){
			$nama = $this->input->post('nama');
			$email = $this->input->post('email');
			$no_telp = $this->input->post('notelp');
			$alamat = $this->input->post('alamat');
			$bidang = $this->input->post('bidang');

			$data = array(
				'NAMA_PERUSAHAAN'		=> strip_tags($nama),
				'EMAIL_PERUSAHAAN'		=> strip_tags($email),
				'NOMOR_TELEPON_PERUSAHAAN'	=> strip_tags($no_telp),
				'ALAMAT_PERUSAHAAN'		=> $alamat,
				'BIDANG_PEKERJAAN'		=> strip_tags($bidang),
			);

			$insert = $this->db->insert($this->tb_perusahaan,$data);
			$last_id = $this->db->insert_id();

			if($insert){
				$response = array('status'=>true, 'message'=>'Berhasil menambah perusahaan.', 'id'=> $last_id);
			}else{
				$response = array('status'=>false, 'message'=>'Kesalahan database', 'id'=> 0);
			}
		}else{
			if(validation_errors()){
				$response = array('status'=>false, 'message'=>validation_errors(), 'id'=> 0);
			}
		}

		$this->outputJson($response);
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

	public function tambahBeasiswa(){
		$this->load->library('form_validation');

		$response = array('status'=>false, 'message'=>null, 'id'=> 0);

		$this->form_validation->set_rules('nama', 'Nama Beasiswa', 'required|min_length[2]|max_length[50]', array(
			'required'	=> 'You have not provided %s.'
        ));
		$this->form_validation->set_rules('penyelenggara', 'Penyelenggara Beasiswa', 'required|min_length[3]|max_length[50]', array(
			'required'	=> 'You have not provided %s.'
        ));

        if($this->form_validation->run()){
			$nama = $this->input->post('nama');
			$penyelenggara = $this->input->post('penyelenggara');

			$data = array(
				'NAMA_BEASISWA'			=> $nama,
				'PENYELENGGARA_BEASISWA'=> $penyelenggara
			);

			$insert = $this->db->insert($this->tb_beasiswa,$data);
			$last_id = $this->db->insert_id();

			if($insert){
				$response = array('status'=>true, 'message'=>'Berhasil menambah beasiswa.', 'id'=> $last_id);
			}else{
				$response = array('status'=>false, 'message'=>'Kesalahan database', 'id'=> 0);
			}
		}else{
			if(validation_errors()){
				$response = array('status'=>false, 'message'=>validation_errors(), 'id'=> 0);
			}
		}

		$this->outputJson($response);
	}

	public function tambahKarya(){
		$this->load->library('form_validation');

		$response = array('status'=>false, 'message'=>null, 'id'=> 0);

		$this->form_validation->set_rules('judul', 'Judul Karya Ilmiah', 'required|min_length[2]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));
		$this->form_validation->set_rules('tujuan', 'Tujuan Karya Ilmiah', 'required|min_length[3]|max_length[255]', array(
			'required'	=> 'You have not provided %s.'
        ));

		if($this->form_validation->run()){
			$judul = $this->input->post('judul');
			$tujuan = $this->input->post('tujuan');
			$thn_selesai = $this->input->post('thn_selesai');

			$data = array(
				'JUDUL_KARYA_ILMIAH'		=> $judul,
				'TUJUAN_PEMBUATAN_KARYA'	=> $tujuan,
				'TAHUN_SELESAI_KARYA'		=> $thn_selesai
			);

			$insert = $this->db->insert($this->tb_karya,$data);
			$last_id = $this->db->insert_id();

			if($insert){
				$response = array('status'=>true, 'message'=>'Berhasil menambah karya.', 'id'=> $last_id);
			}else{
				$response = array('status'=>false, 'message'=>'Kesalahan database', 'id'=> 0);
			}
		}else{
			if(validation_errors()){
				$response = array('status'=>false, 'message'=>validation_errors(), 'id'=> 0);
			}
		}

		$this->outputJson($response);
	}

	public function tambahOrganisasi(){
		$this->load->library('form_validation');

		$response = array('status'=>false, 'message'=>null, 'id'=> 0);

		$this->form_validation->set_rules('nama', 'Nama Organisasi', 'required|min_length[3]|max_length[20]|is_unique[organisasi.NAMA_ORGANISASI]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));

		if($this->form_validation->run()){
			$nama = $this->input->post('nama');

			$data = array(
				'NAMA_ORGANISASI'	=> $nama
			);

			$insert = $this->db->insert($this->tb_organisasi,$data);
			$last_id = $this->db->insert_id();

			if($insert){
				$response = array('status'=>true, 'message'=>'Berhasil menambah organisasi.', 'id'=> $last_id);
			}else{
				$response = array('status'=>false, 'message'=>'Kesalahan database', 'id'=> 0);
			}
		}else{
			if(validation_errors()){
				$response = array('status'=>false, 'message'=>validation_errors(), 'id'=> 0);
			}
		}

		$this->outputJson($response);
	}

	public function tambahKompetisi(){
		$this->load->library('form_validation');

		$response = array('status'=>false, 'message'=>null, 'id'=> 0);

		$this->form_validation->set_rules('nama', 'Nama Kompetisi', 'required|min_length[3]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));
        $this->form_validation->set_rules('penyelenggara', 'Penyelenggara Kompetisi', 'required|min_length[3]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));

		if($this->form_validation->run()){
			$nama = $this->input->post('nama');
			$penyelenggara = $this->input->post('penyelenggara');

			$cek = $this->db->get_where($this->tb_kompetisi,array('NAMA_KOMPETISI'=> $nama,'PENYELENGGARA_KOMPETISI'=>$penyelenggara))->result_array();

			if(empty($cek)){
				$data = array(
					'NAMA_KOMPETISI'			=> $nama,
					'PENYELENGGARA_KOMPETISI' 	=> $penyelenggara
				);

				$insert = $this->db->insert($this->tb_kompetisi,$data);
				$last_id = $this->db->insert_id();

				if($insert){
					$response = array('status'=>true, 'message'=>'Berhasil menambah kompetisi.', 'id'=> $last_id);
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database', 'id'=> 0);
				}
			}else{
				$response = array('status'=>false, 'message'=>'Kompetisi '.$nama.' yang di selanggarakan oleh '.$penyelenggara.' sudah ada.', 'id'=> 0);
			}
		}else{
			if(validation_errors()){
				$response = array('status'=>false, 'message'=>validation_errors(), 'id'=> 0);
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

	public function hapusRiwayatOrganisasi(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			$cek = $this->db->join($this->tb_organisasi,$this->tb_organisasi.'.ID_ORGANISASI='.$this->tb_riwayat_org.'.ID_ORGANISASI');
			$cek = $this->db->get_where($this->tb_riwayat_org,array('ID_RIWAYAT_ORGANISASI' => $id))->result_array();

			if(!empty($cek)){
				$hapus = $this->db->delete($this->tb_riwayat_org,array('ID_RIWAYAT_ORGANISASI' => $id));

				if($hapus){
					$response = array('status'=>true, 'message'=>'Berhasil menghapus riwayat organisasi '.$cek[0]['NAMA_ORGANISASI'].'.');
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database');
				}
			}
		}

		$this->outputJson($response);
	}

	public function hapusRiwayatKompetisi(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			$cek = $this->db->join($this->tb_kompetisi,$this->tb_kompetisi.'.ID_KOMPETISI='.$this->tb_riwayat_komp.'.ID_KOMPETISI');
			$cek = $this->db->get_where($this->tb_riwayat_komp,array('ID_RIWAYAT_KOMPETISI' => $id))->result_array();

			if(!empty($cek)){
				$hapus = $this->db->delete($this->tb_riwayat_komp,array('ID_RIWAYAT_KOMPETISI' => $id));

				if($hapus){
					$response = array('status'=>true, 'message'=>'Berhasil menghapus riwayat kompetisi '.$cek[0]['NAMA_KOMPETISI'].'.');
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database');
				}
			}
		}

		$this->outputJson($response);
	}

	public function hapusPembuatanKarya(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			$cek = $this->db->join($this->tb_karya,$this->tb_karya.'.ID_KARYA_ILMIAH='.$this->tb_membuat_karya.'.ID_KARYA_ILMIAH');
			$cek = $this->db->get_where($this->tb_membuat_karya,array('ID_MEMBUAT_KARYA' => $id))->result_array();

			if(!empty($cek)){
				$hapus = $this->db->delete($this->tb_membuat_karya,array('ID_MEMBUAT_KARYA' => $id));

				if($hapus){
					$response = array('status'=>true, 'message'=>'Berhasil menghapus pembuatan karya '.$cek[0]['JUDUL_KARYA_ILMIAH'].'.');
				}else{
					$response = array('status'=>false, 'message'=>'Kesalahan database');
				}
			}
		}

		$this->outputJson($response);
	}

	public function hapusPendapatanBeasiswa(){
		$response = array('status'=>false, 'message'=>null);

		@$id=$this->input->post('id');

		if(!empty($id)){
			$cek = $this->db->join($this->tb_beasiswa,$this->tb_beasiswa.'.ID_BEASISWA='.$this->tb_mendapat.'.ID_BEASISWA');
			$cek = $this->db->get_where($this->tb_mendapat,array('ID_MENDAPAT_BEASISWA' => $id))->result_array();

			if(!empty($cek)){
				$hapus = $this->db->delete($this->tb_mendapat,array('ID_MENDAPAT_BEASISWA' => $id));

				if($hapus){
					$response = array('status'=>true, 'message'=>'Berhasil menghapus pendapatan beasiswa '.$cek[0]['NAMA_BEASISWA'].'.');
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

				$dataKarya = $this->db->join($this->tb_karya, $this->tb_membuat_karya.'.ID_KARYA_ILMIAH='.$this->tb_karya.'.ID_KARYA_ILMIAH');
				$dataKarya = $this->db->get_where($this->tb_membuat_karya,array('ID_ALUMNI'=>$id))->result_array();

				$riwayatBeasiswa = $this->db->order_by('TAHUN_MULAI_BEASISWA, TAHUN_SELESAI_BEASISWA','DESC');
				$riwayatBeasiswa = $this->db->join($this->tb_beasiswa,$this->tb_mendapat.'.ID_BEASISWA='.$this->tb_beasiswa.'.ID_BEASISWA');
				$riwayatBeasiswa = $this->db->get_where($this->tb_mendapat,['ID_ALUMNI'=>$id])->result_array();

				$riwayatOrganisasi = $this->db->order_by('TAHUN_MULAI_JABATAN, TAHUN_SELESAI_JABATAN','DESC');
				$riwayatOrganisasi = $this->db->join($this->tb_organisasi,$this->tb_riwayat_org.'.ID_ORGANISASI='.$this->tb_organisasi.'.ID_ORGANISASI');
				$riwayatOrganisasi = $this->db->get_where($this->tb_riwayat_org,['ID_ALUMNI'=>$id])->result_array();

				$riwayatKompetisi = $this->db->order_by('TAHUN_KOMPETISI','DESC');
				$riwayatKompetisi = $this->db->join($this->tb_kompetisi,$this->tb_riwayat_komp.'.ID_KOMPETISI='.$this->tb_kompetisi.'.ID_KOMPETISI');
				$riwayatKompetisi = $this->db->get_where($this->tb_riwayat_komp,['ID_ALUMNI'=>$id])->result_array();

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
					'karya_ilmiah'=> $dataKarya,
					'riwayatKerja'=> $riwayatKerja,
					'dapetBeasiswa' => $riwayatBeasiswa,
					'riwayat_org' => $riwayatOrganisasi,
					'riwayat_kompetisi' =>$riwayatKompetisi
				);
			}
			$this->outputJson($data);
		}
	}

	public function ambilSatuKompetisi($id=0){
		if(!empty($id)){
			$data = $this->db->get_where($this->tb_kompetisi,array('ID_KOMPETISI'=>$id))->result_array();

			$data = array(
				'ID_KOMPETISI' => $data[0]['ID_KOMPETISI'],
				'NAMA_KOMPETISI' => $data[0]['NAMA_KOMPETISI'],
				'PENYELENGGARA_KOMPETISI' => $data[0]['PENYELENGGARA_KOMPETISI']
			);

			$this->outputJson($data);
		}
	}

	public function ambilSatuKarya($id=0){
		if(!empty($id)){
			$data = $this->db->get_where($this->tb_karya,array('ID_KARYA_ILMIAH'=>$id))->result_array();

			$data = array(
				'ID_KARYA_ILMIAH' => $data[0]['ID_KARYA_ILMIAH'],
				'JUDUL_KARYA_ILMIAH' => $data[0]['JUDUL_KARYA_ILMIAH'],
				'TUJUAN_PEMBUATAN_KARYA' => $data[0]['TUJUAN_PEMBUATAN_KARYA'],
				'TAHUN_SELESAI_KARYA' => $data[0]['TAHUN_SELESAI_KARYA']
			);

			$this->outputJson($data);
		}
	}
}
