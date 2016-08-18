<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Admin extends Main{

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-06 21:47:30
	**/

	function __construct(){
		parent::__construct();
		$this->load->model(array('m_prodi','m_jurusan'));
		$this->tb_prodi = 'program_studi';
		$this->tb_jurusan = 'jurusan';
	}

	public function index(){
		// Identitas halaman
		$this->global_data['active_menu'] = "dashboard";
		$this->global_data['title'] = "Dashboard";
		$this->global_data['description'] = "Dashboard";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Dashboard',
			'link'	=> ''
		);
	
		$this->tampilan('dashboard');
	}

	public function keluar(){
		$this->session->sess_destroy();
		redirect('admin/auth','refresh');
	}

}
