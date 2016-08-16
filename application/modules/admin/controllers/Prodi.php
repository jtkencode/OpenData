<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Prodi extends Main{

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-09 19:31:49
	**/

	function __construct(){
		parent::__construct();
		// Load model
		$this->load->model(array('m_prodi','m_jurusan'));
		$this->tb_prodi = 'program_studi';
		$this->tb_jurusan = 'jurusan';
		if($this->session->userdata('hak')!='admin'){
			redirect('admin');
		}

		// Load libraries
		$this->load->library('pagination');
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "prodi";
		$this->global_data['title'] = "Program Studi";
		$this->global_data['description'] = "Program Studi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Program Studi',
			'link'	=> site_url('admin/prodi')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Daftar Program Studi',
			'link'	=> ''
		);

		// Pengaturan pagination
		$config['base_url'] = site_url('admin/prodi/index');
		$config['total_rows'] = count($this->m_prodi->getAllProdi());
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
		$prodi = $this->m_prodi->getProdiPer($config['per_page'], $id);

		$this->global_data['dataProdi'] = array();
		$this->global_data['dataJurusan'] = $this->m_jurusan->getAllJurusan();
		$this->global_data['href_tambah'] = site_url('admin/prodi/addProdi');

		$no=1+$id;
		foreach ($prodi as $result) {
			$this->global_data['dataProdi'][] = array(
				'no'			=> $no,
				'id_prodi'		=> $result['ID_PRODI'],
				'id_jurusan'	=> $result['ID_JURUSAN'],
				'nama_jurusan'	=> $result['NAMA_JURUSAN'],
				'nama'			=> $result['NAMA_PRODI'],
				'href_view'		=> site_url('admin/prodi/view/'.$result['ID_PRODI']),
				'href_edit'		=> site_url('admin/prodi/editProdi/'.$result['ID_PRODI']),
				'href_delete'	=> site_url('admin/prodi/deleteProdi/'.$result['ID_PRODI'])
			);
			$no++;
		}

		$this->tampilan('prodi/list');
	}

	public function addProdi(){

		// Identitas halaman
		$this->global_data['active_menu'] = "Prodi";
		$this->global_data['title'] = "Prodi";
		$this->global_data['description'] = "Tambah Prodi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Prodi',
			'link'	=> site_url('admin/prodi')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Prodi',
			'link'	=> ''
		);
		$this->global_data['Jurusan'] = $this->m_prodi->getJurusan();


		$this->global_data['idprodi'] = '';
		$this->global_data['idjurusan'] = '';
		$this->global_data['namaprodi'] = '';
		$this->global_data['namajurusan'] =  '-- Pilih Jurusan --';
		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);

		$this->tampilan('prodi/forminsertData');
	}

	public function simpan(){
		$id = $this->input->post('idprodi');
		$data = array('ID_JURUSAN'=>  $this->input->post('namajurusan'),
									'NAMA_PRODI'=>  $this->input->post('namaprodi'),
								 );

		$query = $this->m_prodi->getData($id);

		if($query->num_rows()>0){
			$this->m_prodi->get_update($id,$data);
			$this->session->set_flashdata('info','data berhasil diupdate');
		}
		else{
			$this->m_prodi->get_insert($data);
			$this->session->set_flashdata('info','data berhasil disimpan');
		}

		redirect('admin/prodi');
	}

	public function editProdi(){

		// Identitas halaman
		$this->global_data['active_menu'] = "Prodi";
		$this->global_data['title'] = "Prodi";
		$this->global_data['description'] = "Edit Prodi";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Prodi',
			'link'	=> site_url('admin/alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit Prodi',
			'link'	=> ''
		);
		$this->global_data['Jurusan'] = $this->m_prodi->getJurusan();
		$id = $this->uri->segment(4);
		$this->db->where('ID_PRODI',$id);
		$query = $this->db->join($this->tb_jurusan, $this->tb_prodi.'.ID_JURUSAN='.$this->tb_jurusan.'.ID_JURUSAN');
		$query = $this->db->get($this->tb_prodi);
		if($query->num_rows()>0){
			foreach ($query->result() as $row) {

					$this->global_data['idprodi'] = $row->ID_PRODI;
					$this->global_data['idjurusan'] = $row->ID_JURUSAN;
					$this->global_data['namaprodi'] = $row->NAMA_PRODI;
					$this->global_data['namajurusan']= $row->NAMA_JURUSAN;
			}
		//	var_dump($query->result());
		}
		else{
			$this->global_data['idprodi'] = '';
			$this->global_data['idjurusan'] = '';
			$this->global_data['namaprodi'] = '';
			$this->global_data['namajurusan'] = '-- Pilih Jurusan --';
		}

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);

		//$this->load->view('admin/jurusan/formEditData');


		$this->tampilan('prodi/forminsertData');
	}


	public function deleteProdi(){

		$id = $this->uri->segment(4);
		$this->m_prodi->get_delete((int)$id);

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);
		redirect('admin/prodi');
	}

}
