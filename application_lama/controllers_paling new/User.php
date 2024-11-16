<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("muser");  
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$data['listUser'] = $this->muser->getAllUser(); 
		$this->load->view('v_header');
		$this->load->view('v_userlist', $data); 
		$this->load->view('v_footer');
	}

	public function addUser()
	{
		$this->load->view('v_header');
		$this->load->view('v_useradd');
		$this->load->view('v_footer');
	}

	public function addUserDb()
	{
		$data = array(
				'userid' => $this->input->post('userid'),
				'password' => $this->input->post('password'),
				'name' => $this->input->post('name'),
				'levelid' => $this->input->post('levelid')
				);
		$this->muser->addUser($data);

		redirect(base_url("user"));
	}

	public function updateUser($id)
	{
		$data['user'] = $this->muser->getUserById($id);
		
		$this->load->view('v_header');
		$this->load->view('v_useredit', $data);
		$this->load->view('v_footer');
	}

	public function updateUserDb()
	{
		$id = $this->input->post('id');

		$data = array(
				'userid' => $this->input->post('userid'),
				'password' => $this->input->post('password'),
				'name' => $this->input->post('name'),
				'levelid' => $this->input->post('levelid'),
				);
		$where['id'] = $id;

		$this->muser->updateUser($data, $where);

		redirect(base_url("user"));
	}

	public function deleteUserDb($id)
	{
		$this->muser->deleteUser($id); 
		redirect(base_url("user"));
	}
}
?>