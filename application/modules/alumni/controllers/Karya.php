<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Karya extends Main{ 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 08:56:03
	**/

	function __construct(){
		parent::__construct();

		$this->load->library(['pagination','form_validation']);
		$this->load->model(['m_karya']);
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "karya_ilmiah";
		$this->global_data['title'] = "Karya Ilmiah";
		$this->global_data['description'] = "Karya Ilmiah";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="glyphicon glyphicon-glass"></i> Karya Ilmiah',
			'link'	=> ''
		);		

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Pengaturan pagination
		$config['base_url'] = site_url('alumni/karya/index');
		$config['total_rows'] = count($this->m_karya->getAll(array('ID_ALUMNI'=> $this->session->userdata('id'))));
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
		$data = $this->m_karya->getAllPer($config['per_page'], $id, array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->global_data['data'] = array();

		$no=1+$id;
		foreach ($data as $result) {
			$this->global_data['data'][] = array(
				'no'				=> $no,
				'id_riwayat'		=> $result['ID_MEMBUAT_KARYA'],
				'id_karya'			=> $result['ID_KARYA_ILMIAH'],
				'judul'				=> $result['JUDUL_KARYA_ILMIAH'],
				'tahun_selesai'		=> $result['TAHUN_SELESAI_KARYA'],
				'tahun_pembuatan'	=> $result['TAHUN_PEMBUATAN'],
				'href_edit'			=> site_url('alumni/karya/edit/'.$result['ID_MEMBUAT_KARYA']),
				'href_delete'		=> site_url('alumni/karya/delete/'.$result['ID_MEMBUAT_KARYA']),
			);
			$no++;
		}

		$this->tampilan('karya/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "karya_ilmiah";
		$this->global_data['title'] = "Tambah Riwayat Karya Ilmiah";
		$this->global_data['description'] = "Tambah riwayat karya ilmiah";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="glyphicon glyphicon-glass"></i> Riwayat Karya Ilmiah',
			'link'	=> site_url('alumni/karya')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Riwayat Karya Ilmiah',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('karya', 'Karya Ilmiah', 'required', array(
			'required'	=> 'You have not provided %s.'
        ));
        
		if($this->form_validation->run()){
			$karya = $this->input->post('karya');
			$thn_selesai = $this->input->post('thn_selesai');

			$cek = $this->m_karya->getOne(array(
				'membuat_karya_ilmiah.ID_KARYA_ILMIAH'=>$karya, 
				'ID_ALUMNI'=>$this->session->userdata('id'),
				'TAHUN_PEMBUATAN'=>$thn_selesai
			));

			if(!empty($cek)){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	Pembuatan karya ilmiah tersebut sudah ada.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/karya/add');
			}else{
				$insert = $this->m_karya->insertRiwayat(array(
					'membuat_karya_ilmiah.ID_KARYA_ILMIAH'=>$karya, 
					'ID_ALUMNI'=>$this->session->userdata('id'),
					'TAHUN_PEMBUATAN'=>$thn_selesai
				));
				if($insert){
					$notif = "<div class=\"alert alert-success alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Alert!</h4>";
					$notif .= "	Berhasil menambah pembuatan karya ilmiah.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/karya');
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

				redirect('alumni/karya/add');
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
			'link'	=> site_url('alumni/karya')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Ubah Riwayat Organisasi',
			'link'	=> ''
		);

		$data = $this->m_karya->getOne(array('ID_MEMBUAT_KARYA'=>$id));

		if(empty($data)){
			redirect('alumni/karya');
		}

		$this->global_data['datana'] = $data;

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('karya', 'Karya Ilmiah', 'required', array(
			'required'	=> 'You have not provided %s.'
        ));
        
		if($this->form_validation->run()){
			$karya = $this->input->post('karya');
			$thn_selesai = $this->input->post('thn_selesai');

			$edit = $this->m_karya->updateRiwayat($id,array(
				'ID_KARYA_ILMIAH'=>$karya,
				'TAHUN_PEMBUATAN'=>$thn_selesai
			));
			if($edit){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Alert!</h4>";
				$notif .= "	Berhasil merubah pembuatan karya ilmiah.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/karya');
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

				redirect('alumni/karya/edit/'.$id);
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

		$this->global_data['karya'] = $this->m_karya->getKarya();

		$this->tampilan('karya/form');
	}
}