<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Perusahaan extends Main{

	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-07 22:58:47
	**/

	function __construct(){
		parent::__construct();
		$this->load->model('m_perusahaan');

		// Load libraries
		$this->load->library('pagination');
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "perusahaan";
		$this->global_data['title'] = "Perusahaan";
		$this->global_data['description'] = "Perusahaan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Perusahaan',
			'link'	=> site_url('admin/perusahaan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Daftar Perusahaan',
			'link'	=> ''
		);

		// Pengaturan pagination
		$config['base_url'] = site_url('admin/perusahaan/index');
		$config['total_rows'] = count($this->m_perusahaan->getAllPerusahaan());
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
		$perusahaan = $this->m_perusahaan->getPerushaanPer($config['per_page'], $id);

		$this->global_data['dataPerusahaan'] = array();

		$no=1+$id;
		foreach ($perusahaan as $result) {
			$this->global_data['dataPerusahaan'][] = array(
				'no'			=> $no,
				'id'			=> $result['ID_PERUSAHAAN'],
				'nama'			=> $result['NAMA_PERUSAHAAN'],
        'email'			=> $result['EMAIL_PERUSAHAAN'],
        'notelp'			=> $result['NOMOR_TELEPON_PERUSAHAAN'],
        'alamat'			=> $result['ALAMAT_PERUSAHAAN'],
        'bidang'			=> $result['BIDANG_PEKERJAAN'],
				'href_view'		=> site_url('admin/perusahaan/view/'.$result['ID_PERUSAHAAN']),
				'href_edit'		=> site_url('admin/perusahaan/editPerusahaan/'.$result['ID_PERUSAHAAN']),
				'href_delete'	=> site_url('admin/perusahaan/deletePerusahaan/'.$result['ID_PERUSAHAAN'])
			);
			$no++;
		}

		$this->tampilan('perusahaan/list');
	}

	public function addPerusahaan(){

    // Identitas halaman
		$this->global_data['active_menu'] = "perusahaan";
		$this->global_data['title'] = "Perusahaan";
		$this->global_data['description'] = "Tambah Perusahaan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Perusahaan',
			'link'	=> site_url('admin/perusahaan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Perusahaan',
			'link'	=> ''
		);


		$this->global_data['idperusahaan'] = '';
		$this->global_data['namaperusahaan'] = '';
    $this->global_data['emailperusahaan'] = '';
    $this->global_data['notelepon'] = '';
    $this->global_data['alamatperusahaan'] = '';
    $this->global_data['bidangpekerjaan'] = '';

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);


		$this->tampilan('perusahaan/forminsertData');
	}

	public function simpan(){
		$id = $this->input->post('idperusahaan');
		$data = array('NAMA_PERUSAHAAN'=>  $this->input->post('namaperusahaan'),
                  'EMAIL_PERUSAHAAN'=>  $this->input->post('emailperusahaan'),
                  'NOMOR_TELEPON_PERUSAHAAN'=>  $this->input->post('notelepon'),
                  'ALAMAT_PERUSAHAAN'=>  $this->input->post('alamatperusahaan'),
                  'BIDANG_PEKERJAAN'=>  $this->input->post('bidangpekerjaan'),
								 );

		$query = $this->m_perusahaan->getData($id);

		if($query->num_rows()>0){
			$this->m_perusahaan->get_update($id,$data);
			$this->session->set_flashdata('info','data berhasil diupdate');
		}
		else{
			$this->load->m_perusahaan->get_insert($data);
			$this->session->set_flashdata('info','data berhasil disimpan');
		}

		redirect('admin/perusahaan');
	}

	public function editPerusahaan(){

    $this->global_data['active_menu'] = "perusahaan";
		$this->global_data['title'] = "Perusahaan";
		$this->global_data['description'] = "Edit Perusahaan";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Perusahaan',
			'link'	=> site_url('admin/perusahaan')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit Perusahaan',
			'link'	=> ''
		);

		$id = $this->uri->segment(4);
		$this->db->where('ID_PERUSAHAAN',$id);
		$query=$this->db->get('perusahaan');
		if($query->num_rows()>0){
			foreach ($query->result() as $row) {

					$this->global_data['idperusahaan'] = $row->ID_PERUSAHAAN;
					$this->global_data['namaperusahaan'] = $row->NAMA_PERUSAHAAN;
          $this->global_data['emailperusahaan'] = $row->EMAIL_PERUSAHAAN;
          $this->global_data['notelepon'] = $row->NOMOR_TELEPON_PERUSAHAAN;
          $this->global_data['alamatperusahaan'] = $row->ALAMAT_PERUSAHAAN;
          $this->global_data['bidangpekerjaan'] = $row->BIDANG_PEKERJAAN;
			}
		}

		else{

        $this->global_data['idperusahaan'] = '';
        $this->global_data['namaperusahaan'] = '';
        $this->global_data['emailperusahaan'] = '';
        $this->global_data['notelepon'] = '';
        $this->global_data['alamatperusahaan'] = '';
        $this->global_data['bidangpekerjaan'] = '';

		}

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);


		$this->tampilan('perusahaan/forminsertData');
	}


	public function deletePerusahaan(){

		$id = $this->uri->segment(4);
		$this->m_perusahaan->get_delete($id);

		$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);
		redirect('admin/perusahaan');
	}

}
