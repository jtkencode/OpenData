<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('url','html'));
		$this->load->database();
	}
	
	public function index(){
		$this->load->model('mread');
		$data = array();
		$data_kategori = array();
		$data2 = array();
		
		foreach ($this->mread->getChartData_Angkatan()->result_array() as $row){
			$data[] = (int) $row['jumlah'];
			$data_kategori[] = (int) $row['TAHUN_MASUK'];
		}
		
		foreach ($this->mread->getChartData_Jurusan()->result_array() as $rows){
			$data2[] = (int) $rows['jumlah2'];
			$result = $this->mread->getJurusanAlumni();
		}
		
		$this->load->view('menu_header');
		$this->load->view('home', array('result'=>$result));
		$this->load->view('home_chart', array(
			'data'=>$data, 
			'data_kategori'=>$data_kategori, 
			'data2'=>$data2, 
		)
		);
		$this->load->view('footer');
	}
	
	public function about(){
		$this->load->view('menu_header');
		$this->load->view('about');
		$this->load->view('footer');
	}
	
	public function chart(){
		$this->load->model('mread');
		$data = array();
		$data_kategori = array();
		$data2 = array();
		
		foreach ($this->mread->getChartData_Angkatan()->result_array() as $row){
			$data[] = (int) $row['jumlah'];
			$data_kategori[] = (int) $row['TAHUN_MASUK'];
		}
		
		foreach ($this->mread->getChartData_Jurusan()->result_array() as $rows){
			$data2[] = (int) $rows['jumlah2'];
			$result = $this->mread->getJurusanAlumni();
		}
		
		$this->load->view('menu_header');
		$this->load->view('chart', array('result'=>$result));
		$this->load->view('home_chart', array(
			'data'=>$data, 
			'data_kategori'=>$data_kategori, 
			'data2'=>$data2, 
		)
		);
		$this->load->view('footer');
	}
}
