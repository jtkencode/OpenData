<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_index extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','html','form'));
		$this->load->database();
	}

	public function index(){
		$this->load->view('menu');
		$this->load->view('home_temp');
		$this->load->view('footer');
	}

	public function about(){
		$this->load->view('menu_ot');
		$this->load->view('about');
		$this->load->view('footer');
	}

	public function chart(){
		$this->load->model('m_read');
		$data = array();
		$data_kategori = array();
		$data2 = array();

		foreach ($this->m_read->getChartData_Angkatan()->result_array() as $row){
			$data[] = (int) $row['jumlah'];
			$data_kategori[] = (int) $row['TAHUN_MASUK'];
		}

		foreach ($this->m_read->getChartData_Jurusan()->result_array() as $rows){
			$data2[] = (int) $rows['jumlah2'];
			$result = $this->m_read->getJurusanAlumni();
		}
		
		$data3 = $this->m_read->getChartPekerjaan($this->input->post('jurusan'), $this->input->post('angkatan'))->result_array();
		$gjur = $this->m_read->getJurusan();
		$angk = $this->m_read->getAngkatan();

		$select = array();

		if($this->input->post()){
			$select = array(
				'jurusan' => $this->input->post('jurusan'),
				'angkatan'	=> $this->input->post('angkatan')
			);
		}
		
		$this->load->view('menu_ot');
		$this->load->view('chart', array('result'=>$result, 'gjur'=>$gjur, 'angk'=>$angk, 'select' => $select));
		$this->load->view('home_chart', array(
			'data'=>$data,
			'data_kategori'=>$data_kategori,
			'data2'=>$data2,
			'data3'=>$data3
		)
		);
		$this->load->view('footer');
	}
}
