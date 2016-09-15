<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Riwayat_kompetisi extends Main{ 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-09-12 16:17:37
	**/

	function __construct(){
		parent::__construct();

		$this->load->library(['pagination','form_validation']);
		$this->load->model(['m_kompetisi']);
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "kompetisi";
		$this->global_data['title'] = "Riwayat Kompetisi";
		$this->global_data['description'] = "Riwayat kompetisi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-history"></i> Riwayat',
			'link'	=> ''
		);	
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Riwayat Kompetisi',
			'link'	=> ''
		);		

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Pengaturan pagination
		$config['base_url'] = site_url('alumni/riwayat_kompetisi/index');
		$config['total_rows'] = count($this->m_kompetisi->getAll(array('ID_ALUMNI'=> $this->session->userdata('id'))));
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
		$data = $this->m_kompetisi->getAllPer($config['per_page'], $id, array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->global_data['data'] = array();

		$no=1+$id;
		foreach ($data as $result) {
			$this->global_data['data'][] = array(
				'no'				=> $no,
				'id_riwayat'		=> $result['ID_RIWAYAT_KOMPETISI'],
				'id_kompetisi'		=> $result['ID_KOMPETISI'],
				'nama_kompetisi'	=> $result['NAMA_KOMPETISI'],
				'prestasi'			=> $result['PRESTASI'],
				'tahun'				=> $result['TAHUN_KOMPETISI'],
				'href_edit'			=> site_url('alumni/riwayat_kompetisi/edit/'.$result['ID_RIWAYAT_KOMPETISI']),
				'href_delete'		=> site_url('alumni/riwayat_kompetisi/delete/'.$result['ID_RIWAYAT_KOMPETISI']),
			);
			$no++;
		}

		$this->tampilan('kompetisi/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "kompetisi";
		$this->global_data['title'] = "Tambah Riwayat Kompetisi";
		$this->global_data['description'] = "Tambah riwayat kompetisi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-history"></i> Riwayat',
			'link'	=> ''
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Riwayat Kompetisi',
			'link'	=> site_url('alumni/riwayat_kompetisi')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Riwayat Kompetisi',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('prestasi', 'Prestasi', 'required|min_length[2]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
		));

		if($this->form_validation->run()){
			$kompetisi = $this->input->post('kompetisi');
			$prestasi = $this->input->post('prestasi');
			$thn = $this->input->post('thn');

			$cek = $this->m_kompetisi->getOne(array(
				'riwayat_kompetisi.ID_KOMPETISI'=>$kompetisi, 
				'ID_ALUMNI'=>$this->session->userdata('id'), 
				'PRESTASI'=>$prestasi,
				'TAHUN_KOMPETISI'=>$thn
			));

			if(!empty($cek)){
				$notif = "<div class=\"alert alert-warning alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-warning\"></i> Pesan!</h4>";
				$notif .= "	Riwayat kompetisi di kompetisi tersebut pada periode ".$thn." sudah ada pada riwayat anda.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/riwayat_kompetisi/add');
			}else{
				$insert = $this->m_kompetisi->insertRiwayat(array(
					'ID_KOMPETISI'=>$kompetisi, 
					'ID_ALUMNI'=>$this->session->userdata('id'), 
					'PRESTASI'=>$prestasi,
					'TAHUN_KOMPETISI'=>$thn
				));
				if($insert){
					$notif = "<div class=\"alert alert-success alert-dismissable\">";
					$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
					$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Pesan!</h4>";
					$notif .= "	Berhasil menambah riwayat kompetisi.";
					$notif .= "</div>";
					$this->session->set_flashdata('message',$notif);

					redirect('alumni/riwayat_kompetisi');
				}
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

				redirect('alumni/riwayat_kompetisi/add');
			}
		}

		$this->form();
	}

	public function edit($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "kompetisi";
		$this->global_data['title'] = "Ubah Riwayat Kompetisi";
		$this->global_data['description'] = "Ubah riwayat kompetisi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-history"></i> Riwayat',
			'link'	=> ''
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Riwayat Kompetisi',
			'link'	=> site_url('alumni/riwayat_kompetisi')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Ubah Riwayat Kompetisi',
			'link'	=> ''
		);

		$data = $this->m_kompetisi->getOne(array('ID_RIWAYAT_KOMPETISI'=>$id));

		if(empty($data)){
			redirect('alumni/riwayat_kompetisi');
		}

		$this->global_data['datana'] = $data;

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		$this->form_validation->set_rules('prestasi', 'Prestasi', 'required|min_length[2]|max_length[20]', array(
			'required'	=> 'You have not provided %s.'
		));

		if($this->form_validation->run()){
			$kompetisi = $this->input->post('kompetisi');
			$prestasi = $this->input->post('prestasi');
			$thn = $this->input->post('thn');

			$edit = $this->m_kompetisi->updateRiwayat($id,array(
				'ID_KOMPETISI'=>$kompetisi,
				'PRESTASI'=>$prestasi,
				'TAHUN_KOMPETISI'=>$thn
			));
			if($edit){
				$notif = "<div class=\"alert alert-success alert-dismissable\">";
				$notif .= "	<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>";
				$notif .= "	<h4><i class=\"icon fa fa-check\"></i> Pesan!</h4>";
				$notif .= "	Berhasil merubah riwayat kompetisi.";
				$notif .= "</div>";
				$this->session->set_flashdata('message',$notif);

				redirect('alumni/riwayat_kompetisi');
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

				redirect('alumni/riwayat_kompetisi/edit/'.$id);
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

		$this->global_data['kompetisi'] = $this->m_kompetisi->getKompetisi();

		$this->tampilan('kompetisi/form');
	}
}