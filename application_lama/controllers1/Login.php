<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("muser");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	public function login()
	{
		$where = array(
				'userid' => $this->input->post('userid'),
				'password' => $this->input->post('password')
				);

		$cek = $this->muser->cekLogin($where)->num_rows();
		$user = $this->muser->getUsername($where);
		
		if($cek > 0){
			$data_session = array(
				'userid' => $user["userid"],
				'nama' => $user["name"],
				'level' => $user["levelid"],
				'position' => $user["levelname"],
				'status' => "login"
				);
			$this->session->set_userdata($data_session);
			redirect(base_url("dashboard"));
		}else{
			$userid = $this->input->post('userid');
			$password = $this->input->post('password');
			if(($userid != "") && ($password != "")) {
				$data = new stdClass();
				$data->error = 'Wrong username or password.';
				$this->load->view('v_login', $data);
			} else{
				$this->load->view('v_login');
			}
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("login"));
	}
}
?>