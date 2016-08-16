<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include_once (dirname(__FILE__) . "/Main.php");

class Profile extends Main{ 
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-12 20:51:25
	**/

	function __construct(){
		parent::__construct();

		$this->load->library('form_validation');
		$this->load->model('m_perusahaan');
	}

	public function index(){
		// Identitas halaman
		$this->global_data['active_menu'] = "profil";
		$this->global_data['title'] = "Profil";
		$this->global_data['description'] = "Profil saya";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Dashboard',
			'link'	=> site_url('alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Profil',
			'link'	=> ''
		);

		$this->global_data['perusahaan'] = $this->m_perusahaan->ambilSemua();
		$this->global_data['historiPekerjaan'] = $this->m_alumni->ambilHistoriPekerjaan(array('ID_ALUMNI'=> $this->session->userdata('id')));

		$this->tampilan('profile/detail');
	}

	function uploadz($nama)
    {
        $config['upload_path'] = './assets/upload/alumni/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '9999';
        $config['max_width']  = '99999';
        $config['max_height']  = '99999';
        $config['overwrite']  = 'true';
        $config['file_name']  = $nama;

        $this->load->library('upload', $config);
        //print_r($config['upload_path']);
        if ( !$this->upload->do_upload())
        {
            $error = array('error' => $this->upload->display_errors());
          print_r($error);

            return "-";

            //$this->load->view('upload_form', $error);
        }
        else
        {   
            $data = $this->upload->data();
            //print_r($data);

            return $data['file_name'];

            //$this->load->view('upload_success', $data);
        }
    }

    public function ubahPassword(){
    	$this->form_validation->set_rules('password', 'Password', 'trim|required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required|matches[password]');

		if($this->form_validation->run()){
        	$password = $this->input->post('password');

        	$ubah = $this->m_alumni->ubah($this->session->userdata('id'),array('PASSWORD'=> $password));

        	if($ubah){
        		$this->session->set_flashdata('message','Berhasil merubah password akun.');
        	}
        }else{
			// Pesan validasi
			$this->global_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		redirect('alumni/profile/ubah');
    }

	public function ubah(){
		// Identitas halaman
		$this->global_data['active_menu'] = "profil";
		$this->global_data['title'] = "Ubah Profil";
		$this->global_data['description'] = "Ubah profil saya";

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Dashboard',
			'link'	=> site_url('alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Profil',
			'link'	=> site_url('alumni/profile')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Ubah Profil',
			'link'	=> ''
		);

		// Data
		$this->global_data['jurusan'] = $this->m_alumni->ambilSemuaJurusan();
		$this->global_data['prodi'] = $this->m_alumni->ambilSemuaProdiBy($this->global_data['akunInfo']['idJurusan']);

		// Validasi
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[4]|max_length[20]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[4]|max_length[250]');
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|min_length[4]|max_length[30]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
		$this->form_validation->set_rules('telp', 'Telp', 'required|numeric', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));

        if($this->form_validation->run()){
        	$prodi = $this->input->post('prodi');
        	$nama = $this->input->post('nama');
        	$email = $this->input->post('email');
        	$telp = $this->input->post('telp');
        	$thnMasuk = $this->input->post('thnMasuk');
        	$thnKeluar = $this->input->post('thnKeluar');
        	$alamat = $this->input->post('alamat');
        	$pekerjaan = $this->input->post('pekerjaan');

        	if(empty($_FILES['userfile']['name'])){
        		$foto = $this->global_data['akunInfo']['FOTO'];
        	}else{
        		unlink("./assets/".$this->global_data['akunInfo']['FOTO']); // delete file sebelumnya
        		$foto = "upload/alumni/".$this->uploadz($this->session->userdata('uname')."_".date('Ymdhis'));
        	}


        	if($thnMasuk<=$thnKeluar){
        		$selisih = $thnKeluar-$thnMasuk;
        		if($selisih == 4 || $selisih == 5){
        			$data = array(
		        		'ID_PRODI'		=> $prodi,
		        		'NAMA_ALUMNI'	=> $nama,
		        		'EMAIL_ALUMNI'	=> $email,
		        		'NO_HP'			=> $telp,
		        		'TAHUN_MASUK'	=> $thnMasuk,
		        		'TAHUN_KELUAR'	=> $thnKeluar,
		        		'ALAMAT_ALUMNI'	=> $alamat,
		        		'PEKERJAAN'		=> $pekerjaan,
		        		'FOTO'			=> $foto
		        	);

		        	$ubah = $this->m_alumni->ubah($this->session->userdata('id'),$data);

		        	if($ubah){
		        		$this->session->set_flashdata('message','Berhasil merubah profil.');
		        	}
        		}else{
        			$this->session->set_flashdata('message','Tidak mungkin anda lulus kurang dari 4 tahun atau lebih dari 5 tahun.');
        		}
        	}else{
        		$this->session->set_flashdata('message','Tahun lulus anda mustahil.');
        	}

        	redirect('alumni/profile/ubah');
        }else{
			// Pesan validasi
			$this->global_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->tampilan('profile/form');
	}
}
