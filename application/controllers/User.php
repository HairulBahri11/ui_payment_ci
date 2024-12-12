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
		$data['listEmployee'] = $this->muser->getAllUser(); 
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
		$levelid = '';
		if($this->input->post('position') == 'Admin'){
			$levelid = 2;
		}else{
			$levelid = 3;
		}
		$data = array(
				'userid' => $this->input->post('userid'),
				'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
				'name' => $this->input->post('name'),
				'levelid' => $levelid,
				'levelname' => $this->input->post('position'),
				'branch_id' => $this->input->post('branch_id'),
				);
		$proses =  $this->db->insert('user', $data);
		if($proses){
			$this->session->set_flashdata('alert','Employee added successfully.');
		}else{
			$this->session->set_flashdata('alert','Employee added failed.');
		}
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
		$id = $this->input->post('username');

		if($this->input->post('position') == 'Admin'){
			$levelid = 2;
		}else{
			$levelid = 3;
		}

		$data = array(
				'userid' => $this->input->post('username'),
				'name' => $this->input->post('name'),
				'levelid' => $levelid,
				'levelname' => $this->input->post('position'),
				'branch_id' => $this->input->post('branch_id'),
				);
		if($this->input->post('password') != '') {
			$data['password'] = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
		}
		$where['userid'] = $id;

		$proses = $this->muser->updateUser($data, $where);
		if($proses){
			$this->session->set_flashdata('alert','User updated successfully.');
		}else{
			$this->session->set_flashdata('alert','User updated failed.');
		}

		redirect(base_url("user"));
	}

	public function deleteUserDb($id)
	{
		$this->muser->deleteUser($id); 
		redirect(base_url("user"));
	}

	public function activateUser($id)
	{
		 $data = array(
				'status' => 'nonactive',
				);
		 $where['userid'] = $id;
		 $update = $this->muser->activateUser($data , $where);
		 if( $update ){
			$this->session->set_flashdata('alert','User nonactivated successfully.');
		 }else{
			$this->session->set_flashdata('alert','User nonactivated failed.');
		 }
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