<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class User extends Main{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-16 13:45:07
	**/

	function __construct(){
		parent::__construct();
		$this->load->model('m_user');

		if($this->session->userdata('hak')!='admin'){
			redirect('admin');
		}

		// Load libraries
		$this->load->library(['pagination','form_validation']);	
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "user";
		$this->global_data['title'] = "Pengguna";
		$this->global_data['description'] = "Daftar pengguna";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> Pengguna',
			'link'	=> site_url('admin/user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Daftar Pengguna',
			'link'	=> ''
		);

		// Pengaturan pagination
		$config['base_url'] = site_url('admin/user/index');
		$config['total_rows'] = count($this->m_user->getAllUser());
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
		$user = $this->m_user->getAllUserPer($config['per_page'], $id);

		$this->global_data['dataUser'] = array();

		$no=1+$id;
		foreach ($user as $result) {
			$this->global_data['dataUser'][] = array(
				'no'			=> $no,
				'id'			=> $result['ID_USER'],
				'username'		=> $result['USERNAME'],
				'status'		=> ($result['STATUS']==1) ? 'Admin' : 'Mahasiswa',
				'jurusan'		=> $result['NAMA_JURUSAN'],
				'prodi'			=> $result['NAMA_PRODI'],
				'href_edit'		=> site_url('admin/user/edit/'.$result['ID_USER'])
			);
			$no++;
		}


		$this->tampilan('user/list');
	}

	public function add(){
		// Identitas halaman
		$this->global_data['active_menu'] = "user_tambah";
		$this->global_data['title'] = "Tambah Pengguna";
		$this->global_data['description'] = "Tambah pengguna";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> Pengguna',
			'link'	=> site_url('admin/user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Pengguna',
			'link'	=> ''
		);

		$this->global_data['jurusan'] = $this->m_user->getAllJurusan();

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Validasi
		$this->form_validation->set_rules('username', 'Username', 'required|min_length[4]|max_length[12]|is_unique[user.USERNAME]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[pass]');
		$this->form_validation->set_rules('prodi', 'Program Studi', 'trim|required');
		$this->form_validation->set_rules('status', 'Status', 'trim|required');

        if($this->form_validation->run()){
        	$username = $this->input->post('username');
        	$password = $this->input->post('pass');
        	$prodi = $this->input->post('prodi');
        	$status = $this->input->post('status');

        	$field = array(
        		'USERNAME'		=> $username,
        		'ID_PRODI'		=> $prodi,
        		'PASSWORD_USER' => $password,
        		'STATUS'		=> $status
        	);

        	$tambah = $this->m_user->tambah($field);
        	if($tambah){
        		$this->session->set_flashdata('message','Berhasil menambah pengguna.');
        		redirect('admin/user/add');
        	}else{
        		$this->session->set_flashdata('message','Gagal. Kesalahan database.');
        		redirect('admin/user/add');
        	}
        }else{
			// Pesan validasi
			$this->global_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->tampilan('user/form');
	}

	public function edit($id=0){
		// Kalo id kosong
		if(empty($id)){
			redirect('admin/user');
		}
		// Identitas halaman
		$this->global_data['active_menu'] = "user_ubah";
		$this->global_data['title'] = "Tambah Pengguna";
		$this->global_data['description'] = "Tambah pengguna";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> Pengguna',
			'link'	=> site_url('admin/user')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Pengguna',
			'link'	=> ''
		);

		$this->global_data['datana'] = $this->m_user->ambilSatuUser(['ID_USER'=>$id]);

		if(empty($this->global_data['datana'])){
			redirect('admin/user');
		}

		$this->global_data['jurusan'] = $this->m_user->getAllJurusan();
		$this->global_data['prodi'] = $this->m_user->ambilSemuaProdiBy($this->global_data['datana']['idJurusan']);
		
		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Validasi
		$this->form_validation->set_rules('pass', 'Password', 'trim|required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[pass]');
		

        if($this->form_validation->run()){
        	$username = $this->input->post('username');
        	$password = $this->input->post('pass');
        	$prodi = $this->input->post('prodi');
        	$status = $this->input->post('status');

        	$field = array(
        		'USERNAME'		=> $username,
        		'ID_PRODI'		=> $prodi,
        		'PASSWORD_USER' => $password,
        		'STATUS'		=> $status
        	);

        	$ubah = $this->m_user->ubah($id,$field);
        	if($ubah){
        		$this->session->set_flashdata('message','Berhasil merubah pengguna.');
        		redirect('admin/user/edit/'.$id);
        	}else{
        		$this->session->set_flashdata('message','Gagal. Kesalahan database.');
        		redirect('admin/user/edit/'.$id);
        	}
        }else{
			// Pesan validasi
			$this->global_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->tampilan('user/form');
	}
	
}