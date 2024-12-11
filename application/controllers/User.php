<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("muser");  
		$this->load->library('form_validation');
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

	public function profile() {
		// $data["user"] = $this->session->userdata("userid");
		$this->load->view('v_header');
		$this->load->view('profile/v_profile'  ); 
		$this->load->view('v_footer');
	}

	public function updateProfileDB() {
		// Set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			// Load profile view with validation errors
			$this->load->view('v_header');
			$this->load->view('profile/v_profile');
			$this->load->view('v_footer');
		} else {
			// Prepare data for update
			$data = array(
				'userid' => $this->input->post('username'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
			);
	
			// Prepare the condition for the update
			$where['userid'] = $this->input->post('username');
	
			// Update the user data
			$update = $this->muser->updateProfile($data, $where);
	
			if ($update) {
				// Set success message and redirect
				$this->session->set_flashdata('success', 'Profile updated successfully.');
				$this->load->view('v_header');
				$this->load->view('profile/v_profile');
				$this->load->view('v_footer');
			} else {
				// Set error message and reload profile view
				$this->session->set_flashdata('error', 'Failed to update profile. Please try again.');
				$this->load->view('v_header');
				$this->load->view('profile/v_profile');
				$this->load->view('v_footer');
			}
		}
	}
	
}
?>