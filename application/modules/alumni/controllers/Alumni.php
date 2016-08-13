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
		redirect('alumni/auth','refresh');
	}

}