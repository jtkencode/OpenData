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

		// cek hak akses admin, bukan mahasiswa biasa
		if($this->session->userdata('hak')!='admin'){
			redirect('admin');
		}

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
				'href_edit'		=> site_url('admin/jurusan/editJurusan/'.$result['ID_JURUSAN']),
				'href_delete'	=> site_url('admin/jurusan/deleteJurusan/'.$result['ID_JURUSAN'])
			);
			$no++;
		}

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);

		$this->tampilan('jurusan/list');
	}

	public function addJurusan(){

		// Identitas halaman
		$this->global_data['active_menu'] = "jurusan";
		$this->global_data['title'] = "Jurusan";
		$this->global_data['description'] = "Tambah Jurusan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Jurusan',
			'link'	=> site_url('admin/jurusan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Jurusan',
			'link'	=> ''
		);


		$this->global_data['idjurusan'] = '';
		$this->global_data['namajurusan'] = '';

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);


		$this->tampilan('jurusan/forminsertData');
	}

	public function simpan(){
		$id = $this->input->post('idjurusan');
		$data = array('NAMA_JURUSAN'=>  $this->input->post('namajurusan'),
								 );

		$query = $this->m_jurusan->getData($id);

		if($query->num_rows()>0){
			$this->m_jurusan->get_update($id,$data);
			$this->session->set_flashdata('info','data berhasil diupdate');
		}
		else{
			$this->load->m_jurusan->get_insert($data);
			$this->session->set_flashdata('info','data berhasil disimpan');
		}

		redirect('admin/jurusan');
	}

	public function editJurusan(){

		// Identitas halaman
		$this->global_data['active_menu'] = "jurusan";
		$this->global_data['title'] = "Jurusan";
		$this->global_data['description'] = "Edit Jurusan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Jurusan',
			'link'	=> site_url('admin/jurusan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit Jurusan',
			'link'	=> ''
		);

		$id = $this->uri->segment(4);
		$this->db->where('ID_JURUSAN',$id);
		$query=$this->db->get('jurusan');
		if($query->num_rows()>0){
			foreach ($query->result() as $row) {
			//	$isi['idjurusan'] 		= $row->ID_JURUSAN;
			//	$isi['namajurusan']		= $row->NAMA_JURUSAN;
					$this->global_data['idjurusan'] = $row->ID_JURUSAN;
					$this->global_data['namajurusan'] = $row->NAMA_JURUSAN;
			}
		}
		else{
		//	$isi['idjurusan'] 		= '';
		//	$isi['namajurusan']		= '';
			$this->global_data['idjurusan'] = '';
				$this->global_data['namajurusan'] = '';

		}

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);

		//$this->load->view('admin/jurusan/formEditData');


		$this->tampilan('jurusan/forminsertData');
	}


	public function deleteJurusan(){

		$id = $this->uri->segment(4);
		$this->m_jurusan->get_delete($id);

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);
		redirect('admin/jurusan');
	}

}
