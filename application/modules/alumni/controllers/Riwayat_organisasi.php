<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Riwayat_organisasi extends Main{ 

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 13:51:49
	**/

	function __construct(){
		parent::__construct();

		$this->load->library(['pagination','form_validation']);
		$this->load->model(['m_organisasi']);
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "organisasi";
		$this->global_data['title'] = "Riwayat Organisasi";
		$this->global_data['description'] = "Riwayat organisasi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-history"></i> Riwayat',
			'link'	=> ''
		);	
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Riwayat Organisasi',
			'link'	=> ''
		);		

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Pengaturan pagination
		$config['base_url'] = site_url('alumni/riwayat_organisasi/index');
		$config['total_rows'] = count($this->m_organisasi->getAll(array('ID_ALUMNI'=> $this->session->userdata('id'))));
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
		$data = $this->m_organisasi->getAllPer($config['per_page'], $id, array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->global_data['data'] = array();

		$no=1+$id;
		foreach ($data as $result) {
			$berhenti=($result['TAHUN_SELESAI_JABATAN']==0) ? 'Sekarang' : $result['TAHUN_SELESAI_JABATAN'];
			$this->global_data['data'][] = array(
				'no'				=> $no,
				'id_riwayat'		=> $result['ID_RIWAYAT_ORGANISASI'],
				'id_organisasi'		=> $result['ID_ORGANISASI'],
				'nama_organisasi'	=> $result['NAMA_ORGANISASI'],
				'jabatan'			=> $result['JABATAN_DI_ORGANISASI'],
				'periode'			=> $result['TAHUN_MULAI_JABATAN'].' - '.$berhenti,
				'href_edit'			=> site_url('alumni/riwayat_organisasi/edit/'.$result['ID_RIWAYAT_ORGANISASI']),
				'href_delete'		=> site_url('alumni/riwayat_organisasi/delete/'.$result['ID_RIWAYAT_ORGANISASI']),
			);
			$no++;
		}

		$this->tampilan('organisasi/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "organisasi";
		$this->global_data['title'] = "Tambah Riwayat Organisasi";
		$this->global_data['description'] = "Tambah riwayat organisasi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-history"></i> Riwayat',
			'link'	=> ''
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Riwayat Organisasi',
			'link'	=> site_url('alumni/riwayat_organisasi')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Riwayat Organisasi',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|min_length[2]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));
        
		if($this->form_validation->run()){
			$organisasi = $this->input->post('organisasi');
			$jabatan = $this->input->post('jabatan');
			$thn_mulai = $this->input->post('thn_mulai');
			$thn_selesai = $this->input->post('thn_selesai');

			$cek = $this->m_organisasi->getOne(array(
				'riwayat_organisasi.ID_ORGANISASI'=>$organisasi, 
				'ID_ALUMNI'=>$this->session->userdata('id'), 
				'JABATAN_DI_ORGANISASI'=>$jabatan,
				'TAHUN_MULAI_JABATAN'=>$thn_mulai,
				'TAHUN_SELESAI_JABATAN'=>$thn_selesai
			));

			if(!empty($cek)){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	Jabatan di organisasi tersebut pada periode ".$thn_mulai." sudah ada.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/riwayat_organisasi/add');
			}else{
				if($thn_mulai <= $thn_selesai || $thn_selesai==0){
					$insert = $this->m_organisasi->insertRiwayat(array(
						'ID_ORGANISASI'=>$organisasi, 
						'ID_ALUMNI'=>$this->session->userdata('id'), 
						'JABATAN_DI_ORGANISASI'=>$jabatan,
						'TAHUN_MULAI_JABATAN'=>$thn_mulai,
						'TAHUN_SELESAI_JABATAN'=>$thn_selesai
					));
					if($insert){
						$notif = "<div class=\"alert alert-success alert-dismissable\">";
						$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
						$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Alert!</h4>";
						$notif .= "	Berhasil menambah riwayat organisasi.";
						$notif .= "</div>";
						$this->session->set_flashdata('message',$notif);

						redirect('alumni/riwayat_organisasi');
					}
				}else{
					$notif = "<div class=\"alert alert-warning alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
					$notif .= "	Periode tahun ber-organisasi tidak sahih.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/riwayat_organisasi/add');
				}
			}
		}else{
			// Pesan validasi
			if(validation_errors()){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	".validation_errors();
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/riwayat_organisasi/add');
			}
		}

		$this->form();
	}

	public function edit($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "organisasi";
		$this->global_data['title'] = "Ubah Riwayat Organisasi";
		$this->global_data['description'] = "Ubah riwayat organisasi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-history"></i> Riwayat',
			'link'	=> ''
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Riwayat Organisasi',
			'link'	=> site_url('alumni/riwayat_organisasi')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Ubah Riwayat Organisasi',
			'link'	=> ''
		);

		$data = $this->m_organisasi->getOne(array('ID_RIWAYAT_ORGANISASI'=>$id));

		if(empty($data)){
			redirect('alumni/riwayat_organisasi');
		}

		$this->global_data['datana'] = $data;

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('jabatan', 'Jabatan', 'required|min_length[2]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
        ));

		if($this->form_validation->run()){
			$organisasi = $this->input->post('organisasi');
			$jabatan = $this->input->post('jabatan');
			$thn_mulai = $this->input->post('thn_mulai');
			$thn_selesai = $this->input->post('thn_selesai');

			if($thn_mulai <= $thn_selesai || $thn_selesai==0){
				$edit = $this->m_organisasi->updateRiwayat($id,array(
					'ID_ORGANISASI'=>$organisasi,
					'JABATAN_DI_ORGANISASI'=>$jabatan,
					'TAHUN_MULAI_JABATAN'=>$thn_mulai,
					'TAHUN_SELESAI_JABATAN'=>$thn_selesai
				));
				if($edit){
					$notif = "<div class=\"alert alert-success alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Alert!</h4>";
					$notif .= "	Berhasil merubah riwayat organisasi.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/riwayat_organisasi');
				}
			}else{
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	Periode tahun ber-organisasi tidak sahih.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/riwayat_organisasi/edit/'.$id);
			}
		}else{
			// Pesan validasi
			if(validation_errors()){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	".validation_errors();
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/riwayat_organisasi/edit/'.$id);
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

		$this->global_data['organisasi'] = $this->m_organisasi->getOrganisasi();

		$this->tampilan('organisasi/form');
	}
}