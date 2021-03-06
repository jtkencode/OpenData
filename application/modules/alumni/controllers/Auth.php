<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller { 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-11 20:07:49
	**/

	function __construct(){
		parent::__construct();

		if($this->session->userdata('isLogin')){
			redirect('alumni');
		}

		$this->load->model('m_alumni');
		$this->load->library('form_validation');
	}

	public function index(){
		// Info halaman
		$data['title']	= $this->config->item('title'). " | Log in";
		$data['description'] = '';
		$data['asset']	= base_url('assets')."/";

		// Pesan
		$data['message'] = $this->session->flashdata('message');

		// Validasi
		$this->form_validation->set_rules('login[username]', 'Username', 'required|min_length[4]|max_length[12]');
		$this->form_validation->set_rules('login[password]', 'Password', 'required');

		if($this->form_validation->run() == true){
			$dataLogin = $this->input->post('login');

			$login = $this->m_alumni->auth($dataLogin);

			if($login){
				$this->session->set_userdata(array(
					'isLogin'   => TRUE,
					'hak'		=> 'alumni',
					'uname'  	=> $login['USERNAME'],
					'id'  		=> $login['ID_ALUMNI'],
				));
				redirect('alumni');
			}else{
				$data['message'] = "Gagal login";
			}
		}else{
			// Pesan validasi
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->load->view('masuk',$data);
	}

}