<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Alumni extends Main{

	/** IBNU ALI
	**/

	function __construct(){
		parent::__construct();
		$this->load->model('m_alumni');
		$this->tb_prodi = 'program_studi';
		$this->tb_alumni = 'alumni';
		// Load libraries
		$this->load->library('pagination');
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "alumni";
		$this->global_data['title'] = "Alumni";
		$this->global_data['description'] = "Alumni";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Alumni',
			'link'	=> site_url('admin/alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Daftar Alumni',
			'link'	=> ''
		);

		// Pengaturan pagination
		$config['base_url'] = site_url('admin/alumni/index');
		$config['total_rows'] = count($this->m_alumni->getAllAlumni());
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
		$alumni = $this->m_alumni->getAlumniPer($config['per_page'], $id);

		$this->global_data['dataAlumni'] = array();

		$no=1+$id;
		foreach ($alumni as $result) {
			$this->global_data['dataAlumni'][] = array(
				'no'			        => $no,
				'id'			        => $result['ID_ALUMNI'],
				'namaProdi'			=> $result['NAMA_PRODI'],
			//	'prodiAlumni'			=> $result['ID_PRODI'],
        'namaAlumni'			=> $result['NAMA_ALUMNI'],
        'tahunMasuk'			=> $result['TAHUN_MASUK'],
        'tahunKeluar'			=> $result['TAHUN_KELUAR'],
        'emailAlumni'			=> $result['EMAIL_ALUMNI'],
        'noHP'		      	=> $result['NO_HP'],
        'alamatAlumni'		=> $result['ALAMAT_ALUMNI'],
        'pekerjaan'		   	=> $result['PEKERJAAN'],
				'href_view'		=> site_url('admin/alumni/view/'.$result['ID_ALUMNI']),
				'href_edit'		=> site_url('admin/alumni/editAlumni/'.$result['ID_ALUMNI']),
				'href_delete'	=> site_url('admin/alumni/deleteAlumni/'.$result['ID_ALUMNI'])
			);
			$no++;
		}

		$this->tampilan('alumni/listAlumni');
	}

	public function addAlumni(){

		// Identitas halaman
		$this->global_data['active_menu'] = "Alumni";
		$this->global_data['title'] = "Alumni";
		$this->global_data['description'] = "Tambah Alumni";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Alumni',
			'link'	=> site_url('admin/alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Alumni',
			'link'	=> ''
		);
		$this->global_data['Prodi'] = $this->m_alumni->getProdi();


		$this->global_data['idalumni'] = '';
		$this->global_data['namaalumni'] = '';
		$this->global_data['idprodi'] = '';
		$this->global_data['namaprodi'] = '';
		$this->global_data['tahunmasuk'] = '';
		$this->global_data['tahunkeluar'] = '';
		$this->global_data['emailalumni'] = '';
		$this->global_data['nohp'] = '';
		$this->global_data['alamatalumni'] = '';
		$this->global_data['pekerjaan'] ='';

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);

		$this->tampilan('alumni/insertAlumni');
	}

	public function simpan(){
		$id = $this->input->post('idalumni');
		$data = array('ID_PRODI'=>  $this->input->post('idprodi'),
									'NAMA_ALUMNI'=>  $this->input->post('namaalumni'),
									'TAHUN_MASUK'=>  $this->input->post('tahunmasuk'),
									'TAHUN_KELUAR'=>  $this->input->post('tahunkeluar'),
									'EMAIL_ALUMNI'=>  $this->input->post('emailalumni'),
									'NO_HP'				=>  $this->input->post('nohp'),
									'ALAMAT_ALUMNI'=>  $this->input->post('alamatalumni'),
									'PEKERJAAN'=>  $this->input->post('pekerjaan'),
								 );

		$query = $this->m_alumni->getData($id);

		if($query->num_rows()>0){
			$this->m_alumni->get_update($id,$data);
			$this->session->set_flashdata('info','data berhasil diupdate');
		}
		else{
			$this->m_alumni->get_insert($data);
			$this->session->set_flashdata('info','data berhasil disimpan');
		}

		redirect('admin/alumni');
	}

	public function editAlumni(){

		// Identitas halaman
		$this->global_data['active_menu'] = "alumni";
		$this->global_data['title'] = "Alumni";
		$this->global_data['description'] = "Edit Alumni";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Alumni',
			'link'	=> site_url('admin/alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit Alumni',
			'link'	=> ''
		);
		$this->global_data['Prodi'] = $this->m_alumni->getProdi();
		$id = $this->uri->segment(4);
		$this->db->where('ID_ALUMNI',$id);
		$query = $this->db->join($this->tb_prodi, $this->tb_alumni.'.ID_PRODI='.$this->tb_prodi.'.ID_PRODI');
		$query = $this->db->get($this->tb_alumni);
		if($query->num_rows()>0){
			foreach ($query->result() as $row) {

					$this->global_data['idalumni'] = $row->ID_ALUMNI;
					$this->global_data['namaalumni'] = $row->NAMA_ALUMNI;
					$this->global_data['idprodi'] = $row->ID_PRODI;
					$this->global_data['namaprodi'] = $row->NAMA_PRODI;
					$this->global_data['tahunmasuk'] = $row->TAHUN_MASUK;
					$this->global_data['tahunkeluar'] = $row->TAHUN_KELUAR;
					$this->global_data['emailalumni'] = $row->EMAIL_ALUMNI;
					$this->global_data['nohp'] = $row->NO_HP;
					$this->global_data['alamatalumni'] = $row->ALAMAT_ALUMNI;
					$this->global_data['pekerjaan'] = $row->PEKERJAAN;
			}
		//	var_dump($query->result());
		}
		else{

			$this->global_data['idalumni'] = '';
			$this->global_data['namaalumni'] = '';
			$this->global_data['idprodi'] = '';
			$this->global_data['namaprodi'] = '';
			$this->global_data['tahunmasuk'] = '';
			$this->global_data['tahunkeluar'] = '';
			$this->global_data['emailalumni'] = '';
			$this->global_data['nohp'] = '';
			$this->global_data['alamatalumni'] = '';
			$this->global_data['pekerjaan'] ='';

		}

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);

		//$this->load->view('admin/jurusan/formEditData');


		$this->tampilan('alumni/insertAlumni');
	}


	public function deleteAlumni(){

		$id = $this->uri->segment(4);
		$this->m_alumni->get_delete((int)$id);

		/*$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);*/
		redirect('admin/alumni');
	}

}
