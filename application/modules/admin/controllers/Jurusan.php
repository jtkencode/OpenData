<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Jurusan extends Main{ 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-07 22:58:47
	**/

	function __construct(){
		parent::__construct();
		$this->load->model('m_jurusan');

		// Load libraries
		$this->load->library('pagination');
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "jurusan";
		$this->global_data['title'] = "Jurusan";
		$this->global_data['description'] = "Jurusan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Jurusan',
			'link'	=> site_url('admin/jurusan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Daftar Jurusan',
			'link'	=> ''
		);

		// Pengaturan pagination
		$config['base_url'] = site_url('admin/jurusan/index');
		$config['total_rows'] = count($this->m_jurusan->getAllJurusan());
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
		$jurusan = $this->m_jurusan->getJurusanPer($config['per_page'], $id);

		$this->global_data['dataJurusan'] = array();

		$no=1+$id;
		foreach ($jurusan as $result) {
			$this->global_data['dataJurusan'][] = array(
				'no'			=> $no,
				'id'			=> $result['ID_JURUSAN'],
				'nama'			=> $result['NAMA_JURUSAN'],
				'href_view'		=> site_url('admin/jurusan/view/'.$result['ID_JURUSAN']),
				'href_edit'		=> site_url('admin/jurusan/edit/'.$result['ID_JURUSAN']),
				'href_delete'	=> site_url('admin/jurusan/delete/'.$result['ID_JURUSAN'])
			);
			$no++;
		}

		$this->tampilan('jurusan/list');
	}

	
}