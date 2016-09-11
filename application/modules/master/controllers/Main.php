<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-06 21:45:43
	**/

	function __construct(){
		parent::__construct();

		// Cek login pengguna
		if(!$this->session->userdata('isLogin')){
			redirect('master/auth');
		}

		// Cek hak akses
		if($this->session->userdata('hak')=='alumni'){
			$this->session->sess_destroy();
			redirect('master/auth');
		}

		// Load library
		$library = array();
		$this->load->library($library);

		// Load model yng di butuhkan buat semua kontroller
		$models = array('m_user');
		$this->load->model($models);

		// Var global
		$this->global_data = array();

		// Asset folder
		$this->global_data['asset'] = base_url('assets').'/';

		// akun info
		$this->global_data['akunInfo'] = $this->m_user->ambilSatuUser(array('ID_USER'=> $this->session->userdata('id')));
	}

	protected function tampilan($view_name){
		$this->load->view('meta',$this->global_data);
        $this->load->view('header',$this->global_data);
        $this->load->view('menu',$this->global_data);
		$this->load->view($view_name,$this->global_data);
		$this->load->view('footer',$this->global_data);
	}

}