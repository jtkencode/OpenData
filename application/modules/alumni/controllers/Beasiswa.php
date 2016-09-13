<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Beasiswa extends Main{ 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 19:49:53
	**/

	function __construct(){
		parent::__construct();

		$this->load->library(['pagination','form_validation']);
		$this->load->model(['m_beasiswa']);
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "beasiswa";
		$this->global_data['title'] = "Beasiswa";
		$this->global_data['description'] = "Beasiswa";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="glyphicon glyphicon-glass"></i> Karya Ilmiah',
			'link'	=> ''
		);		

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Pengaturan pagination
		$config['base_url'] = site_url('alumni/beasiswa/index');
		$config['total_rows'] = count($this->m_beasiswa->getAll(array('ID_ALUMNI'=> $this->session->userdata('id'))));
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
		$data = $this->m_beasiswa->getAllPer($config['per_page'], $id, array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->global_data['data'] = array();

		$no=1+$id;
		foreach ($data as $result) {
			$this->global_data['data'][] = array(
				'no'				=> $no,
				'id_mendapat'		=> $result['ID_MENDAPAT_BEASISWA'],
				'id_beasiswa'		=> $result['ID_BEASISWA'],
				'nama'				=> $result['NAMA_BEASISWA'],
				'penyelenggara'		=> $result['PENYELENGGARA_BEASISWA'],
				'tahun_mulai'		=> $result['TAHUN_MULAI_BEASISWA'],
				'tahun_selesai'		=> $result['TAHUN_SELESAI_BEASISWA'],
				'href_edit'			=> site_url('alumni/beasiswa/edit/'.$result['ID_MENDAPAT_BEASISWA']),
				'href_delete'		=> site_url('alumni/beasiswa/delete/'.$result['ID_MENDAPAT_BEASISWA']),
			);
			$no++;
		}

		$this->tampilan('beasiswa/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "beasiswa";
		$this->global_data['title'] = "Tambah Beasiswa";
		$this->global_data['description'] = "Tambah beasiswa";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="glyphicon glyphicon-glass"></i> Beasiswa',
			'link'	=> site_url('alumni/beasiswa')
		);	
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Beasiswa',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('beasiswa', 'Beasiswa', 'required', array(
			'required'	=> 'You have not provided %s.'
        ));
        
		if($this->form_validation->run()){
			$beasiswa = $this->input->post('beasiswa');
			$tahun_mulai = $this->input->post('thn_mulai');
			$tahun_selesai = $this->input->post('thn_selesai');

			$cek = $this->m_beasiswa->getOne(array(
				'mendapat_beasiswa.ID_BEASISWA'=>$beasiswa, 
				'ID_ALUMNI'=>$this->session->userdata('id'),
				'TAHUN_MULAI_BEASISWA'=>$tahun_mulai,
				'TAHUN_SELESAI_BEASISWA'=>$tahun_selesai
			));

			if(!empty($cek)){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	Beasiswa tersebut sudah ada.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/beasiswa/add');
			}else{
				if($tahun_mulai <= $tahun_selesai || $tahun_selesai==0){
					$insert = $this->m_beasiswa->insertRiwayat(array(
						'ID_BEASISWA'=>$beasiswa, 
						'ID_ALUMNI'=>$this->session->userdata('id'),
						'TAHUN_MULAI_BEASISWA'=>$tahun_mulai,
						'TAHUN_SELESAI_BEASISWA'=>$tahun_selesai
					));
					if($insert){
						$notif = "<div class=\"alert alert-success alert-dismissable\">";
						$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
						$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Alert!</h4>";
						$notif .= "	Berhasil menambahkan beasiswa ke akun anda.";
						$notif .= "</div>";
						$this->session->set_flashdata('message',$notif);

						redirect('alumni/beasiswa');
					}
				}else{
					$notif = "<div class=\"alert alert-warning alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
					$notif .= "	Periode pendapatan beasiswa tidak sahih.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/beasiswa/add');
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

				redirect('alumni/beasiswa/add');
			}
		}

		$this->form();
	}

	public function edit($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "beasiswa";
		$this->global_data['title'] = "Ubah Beasiswa";
		$this->global_data['description'] = "Ubah beasiswa";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="glyphicon glyphicon-glass"></i> Beasiswa',
			'link'	=> site_url('alumni/beasiswa')
		);	
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Ubah Beasiswa',
			'link'	=> ''
		);

		$data = $this->m_beasiswa->getOne(array('ID_MENDAPAT_BEASISWA'=>$id));

		if(empty($data)){
			redirect('alumni/pekerjaan');
		}

		$this->global_data['datana'] = $data;

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('beasiswa', 'Beasiswa', 'required', array(
			'required'	=> 'You have not provided %s.'
        ));

		if($this->form_validation->run()){
			$beasiswa = $this->input->post('beasiswa');
			$tahun_mulai = $this->input->post('thn_mulai');
			$tahun_selesai = $this->input->post('thn_selesai');

			if($tahun_mulai <= $tahun_selesai || $tahun_selesai==0){
				$edit = $this->m_beasiswa->updateRiwayat($id,array(
					'ID_BEASISWA'=>$beasiswa,
					'TAHUN_MULAI_BEASISWA'=>$tahun_mulai,
					'TAHUN_SELESAI_BEASISWA'=>$tahun_selesai
				));
				if($edit){
					$notif = "<div class=\"alert alert-success alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Alert!</h4>";
					$notif .= "	Berhasil merubah mendapat beasiswa.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/beasiswa');
				}
			}else{
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Alert!</h4>";
				$notif .= "	Periode pendapatan beasiswa tidak sahih.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/beasiswa/edit/'.$id);
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

				redirect('alumni/beasiswa/add');
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

		$this->global_data['beasiswa'] = $this->m_beasiswa->getBeasiswa();

		$this->tampilan('beasiswa/form');
	}
}