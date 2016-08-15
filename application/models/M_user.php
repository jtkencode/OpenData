<?php  
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_user extends CI_Model{
	
	/**
		* @Author				: Localhost {Ferdhika Yudira}
		* @Email				: fer@dika.web.id
		* @Web					: http://dika.web.id
		* @Date					: 2016-08-06 23:12:55
	**/

	function __construct(){
		parent::__construct();
		$this->tb_user = 'user';
	}

	public function auth($info=array()){
		$query = $this->db->get_where($this->tb_user, array('USERNAME'=> $info['username'], 'PASSWORD_USER'=>$info['password']));
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

	public function ambilSatuUser($where){
		$query = $this->db->get_where($this->tb_user,$where);
		$query = $query->result_array();

		if(!empty($query)){
			return $query[0];
		}
	}

}