<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Profile extends Main{ 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-12 20:51:25
	**/

	function __construct(){
		parent::__construct();

	}

	public function index(){
		// Identitas halaman
		$this->global_data['active_menu'] = "profil";
		$this->global_data['title'] = "Profil";
		$this->global_data['description'] = "Profil saya";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Dashboard',
			'link'	=> site_url('alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Profil',
			'link'	=> ''
		);

		$this->global_data['historiPekerjaan'] = $this->m_alumni->ambilHistoriPekerjaan(array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->tampilan('profile/detail');
	}

}