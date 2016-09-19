<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Alumni extends Main{

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-11 20:06:40
	**/

	function __construct(){
		parent::__construct();

		$this->load->model('m_perusahaan');
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

		$this->global_data['perusahaan'] = $this->m_perusahaan->ambilSemua();
		$this->global_data['historiPekerjaan'] = $this->m_alumni->ambilHistoriPekerjaan(array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->tampilan('dashboard');
	}

	public function keluar(){
		$this->session->sess_destroy();
		redirect('../index.php','refresh');
	}

}
