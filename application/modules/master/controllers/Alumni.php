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
		$this->tb_TA = 'tugas_akhir';
		// Load libraries
		$this->load->library(['pagination','form_validation']);
	}

	public function index($id=0){
		// Identitas halaman
		$this->global_data['active_menu'] = "alumni";
		$this->global_data['title'] = "Alumni";
		$this->global_data['description'] = "Alumni";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-dashboard"></i> Alumni',
			'link'	=> site_url('master/alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Daftar Alumni',
			'link'	=> ''
		);

		// Pengaturan pagination
		$config['base_url'] = site_url('master/alumni/index');
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

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

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
				'href_view'		=> site_url('master/alumni/view/'.$result['ID_ALUMNI']),
				'href_edit'		=> site_url('master/alumni/editAlumni/'.$result['ID_ALUMNI']),
				'href_delete'	=> site_url('master/alumni/deleteAlumni/'.$result['ID_ALUMNI'])
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
			'judul'	=> '<i class="fa fa-user"></i> Alumni',
			'link'	=> site_url('master/alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Tambah Alumni',
			'link'	=> ''
		);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Validasi
		$this->form_validation->set_rules('nim', 'NIM', 'required|numeric|is_unique[alumni.USERNAME]|max_length[9]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
		$this->form_validation->set_rules('namaalumni', 'Nama', 'trim|required');
		$this->form_validation->set_rules('prodi', 'Prodi', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
		$this->form_validation->set_rules('nohp', 'Telp', 'required|numeric', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[4]|max_length[250]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));

        if($this->form_validation->run()){
        	$nim = $this->input->post('nim');
        	$nama = $this->input->post('namaalumni');
        	$email = $this->input->post('email');
        	$telp = $this->input->post('nohp');
        	$prodi = $this->input->post('prodi');
        	$thn_masuk = $this->input->post('thn_masuk');
        	$thn_keluar = $this->input->post('thn_keluar');
        	$ta = $this->input->post('ta');
        	$pekerjaan = $this->input->post('pekerjaan');
        	$alamat = $this->input->post('alamat');

        	if($thn_masuk<=$thn_keluar){
        		$selisih = $thn_keluar-$thn_masuk;
        		$ambilProdi = $this->m_alumni->ambilSatuProdi(array('ID_PRODI'=>$prodi));
        		if (preg_match("/D4/i", $ambilProdi['NAMA_PRODI'])) {
        			$min = 4;
        			$max = 5;
        		}else{
        			$min = 3;
        			$max = 4;
        		}
        		if($selisih == $min || $selisih == $max){
		        	$datana = array(
		        		'ID_PRODI' 			=> $prodi,
		        		'ID_TUGAS_AKHIR'	=> $ta,
		        		'NAMA_ALUMNI'		=> $nama,
		        		'TAHUN_MASUK'		=> $thn_masuk,
		        		'TAHUN_KELUAR'		=> $thn_keluar,
		        		'EMAIL_ALUMNI'		=> $email,
		        		'NO_HP'				=> $telp,
		        		'ALAMAT_ALUMNI'		=> $alamat,
		        		'PEKERJAAN'			=> $pekerjaan,
		        		'USERNAME'			=> $nim,
		        		'PASSWORD'			=> 123456
		        	);

		        	$tambah = $this->m_alumni->get_insert($datana);
		        	if($tambah){
		        		$this->session->set_flashdata('message','Berhasil menambah alumni.');
		        		redirect('master/alumni');
		        	}
		        }else{
        			$this->session->set_flashdata('message','Tidak mungkin alumni lulus kurang dari 4 tahun atau lebih dari 5 tahun.');
        			redirect('master/alumni/addAlumni');
        		}
        	}else{
        		$this->session->set_flashdata('message','Tahun lulus alumni mustahil.');
        		redirect('master/alumni/addAlumni');
        	}
        }else{
			// Pesan validasi
			$this->global_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->form();
	}

	public function editAlumni(){

		// Identitas halaman
		$this->global_data['active_menu'] = "alumni";
		$this->global_data['title'] = "Alumni";
		$this->global_data['description'] = "Edit Alumni";

		// Breadcumb
		$this->global_data['breadcumb'][] = array(
			'judul'	=> '<i class="fa fa-user"></i> Alumni',
			'link'	=> site_url('master/alumni')
		);
		$this->global_data['breadcumb'][] = array(
			'judul'	=> 'Edit Alumni',
			'link'	=> ''
		);
		$this->global_data['Prodi'] = $this->m_alumni->getProdi();
		$id = $this->uri->segment(4);
		$this->db->where('ID_ALUMNI',$id);
		$query = $this->db->select('*, '.$this->tb_prodi.'.ID_JURUSAN as idJurusan, '.$this->tb_alumni.'.ID_PRODI as idProdi');
		$query = $this->db->join($this->tb_prodi, $this->tb_alumni.'.ID_PRODI='.$this->tb_prodi.'.ID_PRODI');
		$query = $this->db->get($this->tb_alumni)->result_array();

		if(empty($query)){
			redirect('master/alumni');
		}else{
			$query = $query[0];
		}

		$this->global_data['datana'] = $query;

		$this->global_data['prodi'] = $this->m_user->ambilSemuaProdiBy($this->global_data['datana']['idJurusan']);

		// Pesan
		$this->global_data['message'] = $this->session->flashdata('message');

		// Validasi
		$this->form_validation->set_rules('nim', 'NIM', 'required|numeric|max_length[9]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
		$this->form_validation->set_rules('namaalumni', 'Nama', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email|required');
		$this->form_validation->set_rules('nohp', 'Telp', 'required|numeric', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'required|trim', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim|min_length[4]|max_length[250]', array(
			'required'	=> 'You have not provided %s.',
			'is_unique'	=> 'This %s already exists.'
        ));

        if($this->form_validation->run()){
        	$nama = $this->input->post('namaalumni');
        	$email = $this->input->post('email');
        	$telp = $this->input->post('nohp');
        	$prodi = $this->input->post('prodi');
        	$thn_masuk = $this->input->post('thn_masuk');
        	$thn_keluar = $this->input->post('thn_keluar');
        	$ta = $this->input->post('ta');
        	$pekerjaan = $this->input->post('pekerjaan');
        	$alamat = $this->input->post('alamat');
        	$nim = $this->input->post('nim');

        	if($thn_masuk<=$thn_keluar){
        		$selisih = $thn_keluar-$thn_masuk;
        		$ambilProdi = $this->m_alumni->ambilSatuProdi(array('ID_PRODI'=>$prodi));
        		if (preg_match("/D4/i", $ambilProdi['NAMA_PRODI'])) {
        			$min = 4;
        			$max = 5;
        		}else{
        			$min = 3;
        			$max = 4;
        		}
        		if($selisih == $min || $selisih == $max){
		        	$datana = array(
		        		'ID_PRODI' 			=> $prodi,
		        		'ID_TUGAS_AKHIR'	=> $ta,
		        		'NAMA_ALUMNI'		=> $nama,
		        		'TAHUN_MASUK'		=> $thn_masuk,
		        		'TAHUN_KELUAR'		=> $thn_keluar,
		        		'EMAIL_ALUMNI'		=> $email,
		        		'NO_HP'				=> $telp,
		        		'ALAMAT_ALUMNI'		=> $alamat,
		        		'PEKERJAAN'			=> $pekerjaan,
		        		'USERNAME'			=> $nim
		        	);

		        	$ubah = $this->m_alumni->get_update($id,$datana);
		        	if($ubah){
		        		$this->session->set_flashdata('message','Berhasil merubah alumni.');
		        		redirect('master/alumni');
		        	}
		        }else{
        			$this->session->set_flashdata('message','Tidak mungkin alumni lulus kurang dari 4 tahun atau lebih dari 5 tahun.');
        			redirect('master/alumni/editAlumni/'.$id);
        		}
        	}else{
        		$this->session->set_flashdata('message','Tahun lulus alumni mustahil.');
        		redirect('master/alumni/editAlumni/'.$id);
        	}
        }else{
			// Pesan validasi
			$this->global_data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		}

		$this->form();
	}

	private function form(){
		// Add style up
		$this->global_data['style'] = array(
			base_url('assets/plugins/select2/select2.min.css')
		);

		// Add script down
		$this->global_data['script'] = array(
			base_url('assets/plugins/select2/select2.full.min.js')
		);

		$this->global_data['add_script'] = array(
			'$(function () {
				//Initialize Select2 Elements
				$(".select2").select2();
			});'
		);

		$this->global_data['jurusan'] = $this->m_user->getAllJurusan();
		$this->global_data['ta'] = $this->m_alumni->ambilTA();

		$this->tampilan('alumni/insertAlumni');
	}

	public function deleteAlumni(){

		$id = $this->uri->segment(4);
		$this->m_alumni->get_delete((int)$id);

		/*$this->global_data['csrf'] = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash()
			);*/
		redirect('master/alumni');
	}

}
