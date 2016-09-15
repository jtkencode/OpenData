<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Pekerjaan extends Main{ 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-11 17:48:31
	**/

	function __construct(){
		parent::__construct();

		$this->load->library(['pagination','form_validation']);
		$this->load->model(['m_pekerjaan','m_perusahaan']);
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "pekerjaan";
		$this->global_data['title'] = "Riwayat Pekerjaan";
		$this->global_data['description'] = "Riwayat pekerjaan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-briefcase"></i> Pekerjaan',
			'link'	=> ''
		);		

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Pengaturan pagination
		$config['base_url'] = site_url('alumni/pekerjaan/index');
		$config['total_rows'] = count($this->m_pekerjaan->getAll(array('ID_ALUMNI'=> $this->session->userdata('id'))));
		$config['per_page'] = $this->config->item('jumlah_pagination');
		$config['full_tag_open'] = '<div class="box-footer clearfix"><ul class="pagination pagination-sm no-margin pull-right">';
		$config['full_tag_close'] = '</ul></div>';
		$config['next_link'] = 'Lanjut &raquo;';
		$config['prev_link'] = '&laquo; Kembali';
		$config['cur_tag_open'] = '<li class="disabled"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['num_links'] = 1;
		$config['last_link'] = '<b>Akhir &rsaquo;</b>';
		$config['first_link'] = '<b>&lsaquo; Awal</b>';

		//inisialisasi config pagination
		$this->pagination->initialize($config);

		//buat pagination
		$this->global_data['halaman'] = $this->pagination->create_links();

		// data
		$data = $this->m_pekerjaan->getAllPer($config['per_page'], $id, array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->global_data['data'] = array();

		$no=1+$id;
		foreach ($data as $result) {
			$berhenti=($result['TAHUN_BERHENTI']==date('Y')) ? 'Sekarang' : $result['TAHUN_BERHENTI'];
			$this->global_data['data'][] = array(
				'no'				=> $no,
				'id_bekerja'		=> $result['ID_BEKERJA'],
				'id_perusahaan'		=> $result['ID_PERUSAHAAN'],
				'nama_perusahaan'	=> $result['NAMA_PERUSAHAAN'],
				'jabatan'			=> $result['JABATAN_PEKERJAAN'],
				'periode'			=> $result['TAHUN_MULAI'].' - '.$berhenti,
				'href_edit'			=> site_url('alumni/pekerjaan/edit/'.$result['ID_BEKERJA']),
				'href_delete'		=> site_url('alumni/pekerjaan/delete/'.$result['ID_BEKERJA']),
			);
			$no++;
		}

		$this->tampilan('pekerjaan/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "pekerjaan";
		$this->global_data['title'] = "Tambah Riwayat Pekerjaan";
		$this->global_data['description'] = "Tambah riwayat pekerjaan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-briefcase"></i> Pekerjaan',
			'link'	=> site_url('alumni/pekerjaan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Pekerjaan',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|min_length[2]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|is_unique[bekerja.ID_PERUSAHAAN]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'Anda sudah bekeja di %s tersebut.'
        ));
        
		if($this->form_validation->run()){
			$perusahaan = $this->input->post('perusahaan');
			$jabatan = strip_tags($this->input->post('jabatan'));
			$thn_mulai = $this->input->post('thn_mulai');
			$thn_berhenti = $this->input->post('thn_berhenti');

			if($thn_mulai <= $thn_berhenti || $thn_berhenti==0){
				$insert = $this->m_pekerjaan->insert(array(
					'ID_ALUMNI'			=> $this->session->userdata('id'),
					'ID_PERUSAHAAN'		=> $perusahaan,
					'JABATAN_PEKERJAAN'	=> $jabatan,
					'TAHUN_BERHENTI'	=> $thn_berhenti,
					'TAHUN_MULAI'		=> $thn_mulai
				));
				if($insert){
					$notif = "<div class=\"alert alert-success alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Pesan!</h4>";
					$notif .= "	Berhasil menambah riwayat pekerjaan.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/pekerjaan');
				}
			}else{
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Pesan!</h4>";
				$notif .= "	Periode tahun bekerja tidak sahih.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/pekerjaan/add');
			}
		}else{
			// Pesan validasi
			if(validation_errors()){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Pesan!</h4>";
				$notif .= "	".validation_errors();
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/pekerjaan/add');
			}
		}

		$this->form();
	}

	public function edit($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "pekerjaan";
		$this->global_data['title'] = "Ubah Riwayat Pekerjaan";
		$this->global_data['description'] = "Ubah riwayat pekerjaan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-briefcase"></i> Pekerjaan',
			'link'	=> site_url('alumni/pekerjaan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Pekerjaan',
			'link'	=> ''
		);

		$data = $this->m_pekerjaan->getOne(array('ID_BEKERJA'=>$id));

		if(empty($data)){
			redirect('alumni/pekerjaan');
		}

		$this->global_data['datana'] = $data;

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|min_length[2]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));

		if($this->form_validation->run()){
			$perusahaan = $this->input->post('perusahaan');
			$jabatan = strip_tags($this->input->post('jabatan'));
			$thn_mulai = $this->input->post('thn_mulai');
			$thn_berhenti = $this->input->post('thn_berhenti');

			if($thn_mulai <= $thn_berhenti || $thn_berhenti==0){
				$edit = $this->m_pekerjaan->update($id,array(
					'ID_PERUSAHAAN'		=> $perusahaan,
					'JABATAN_PEKERJAAN'	=> $jabatan,
					'TAHUN_BERHENTI'	=> $thn_berhenti,
					'TAHUN_MULAI'		=> $thn_mulai
				));
				if($edit){
					$notif = "<div class=\"alert alert-success alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Pesan!</h4>";
					$notif .= "	Berhasil merubah riwayat pekerjaan.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/pekerjaan');
				}
			}else{
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Pesan!</h4>";
				$notif .= "	Periode tahun bekerja tidak sahih.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/pekerjaan/edit/'.$id);
			}
		}else{
			// Pesan validasi
			if(validation_errors()){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Pesan!</h4>";
				$notif .= "	".validation_errors();
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/pekerjaan/edit/'.$id);
			}
		}

		$this->form();
	}

	private function form(){
		// Add style up
		$this->global_data['style'] = array(
			base_url('assets/plugins/select2/select2.min.css')
		);

		// Add script down
		$this->global_data['script'] = array(
			base_url('assets/plugins/select2/select2.full.min.js')
		);

		$this->global_data['add_script'] = array(
			'$(function () {
				//Initialize Select2 Elements
				$(".select2").select2();
			});'
		);

		$this->global_data['perusahaan'] = $this->m_pekerjaan->getPerusahaan();

		$this->tampilan('pekerjaan/form');
	}
}