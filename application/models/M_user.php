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
	}

	public function auth($info=array()){
		$response = false;

		if($info['username']=='admin' && $info['password']=='admin'){
			$response = true;
		}

		return $response;
	}

}