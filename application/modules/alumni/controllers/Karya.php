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
		$this->load->model(['m_karya','m_perusahaan']);
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


		$this->tampilan('karya/list');
	}

}