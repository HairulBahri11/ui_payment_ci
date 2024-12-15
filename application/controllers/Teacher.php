<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Teacher extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("mteacher");
		$this->load->library('form_validation');
		$this->load->library('session');
		$this->load->library('bcrypt');
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$data['data'] = $this->mteacher->index();
		$this->load->view('v_header');
		$this->load->view('v_teacherlist', $data);
		$this->load->view('v_footer');
	}

	public function create()
	{
		$this->load->view('v_header');
		$this->load->view('v_teacherform');
		$this->load->view('v_footer');
	}

	public function store()
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_header');
			$this->load->view('v_teacherform');
			$this->load->view('v_footer');
		} else {
			date_default_timezone_set("Asia/Jakarta");
			$date = date('Y-m-d');
			$time = date('Y-m-d h:i:s');
			
			
			$this->load->library('upload');
			$signature = '';
			
			if(count($_FILES)>0){
			    if($_FILES['signature']['error']==0){
			        $config['upload_path']      = $_SERVER['DOCUMENT_ROOT'] . '/ui-master-update/upload/signature';
			        $config['allowed_types']    = 'png|jpg|jpeg';
			        $config['overwrite']        = FALSE;
			        $config['remove_spaces']    = TRUE;
			        $config['encrypt_name']     = TRUE;
			        $config['max_size']         = '1024';
			        
			        $this->upload->initialize($config);
			        
			        if(!$this->upload->do_upload('signature')){
			            $this->upload->display_errors();
			        }
			        else{
			            $signature = $this->upload->file_name;
			        }
			        
			    }
			}
			
			
			$data = array(
				'name'      => $this->input->post('name'),
				'username'  => $this->input->post('username'),
				'password'  => $this->bcrypt->hash_password('password'),
				'signature' => $signature
				
			);
			$latestRecordStudent = $this->mteacher->store($data);
			$this->session->set_flashdata('success', "Add Teacher Success");
			redirect(base_url("teacher"));
		}
	}

	public function edit($id)
	{
		$data['teacher'] = $this->mteacher->edit($id);
		$this->load->view('v_header');
		$this->load->view('v_teacheredit', $data);
		$this->load->view('v_footer');
	}

	public function update($id)
	{
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$data['teacher'] = $this->mteacher->edit($id);
			$this->load->view('v_header');
			$this->load->view('v_teacheredit', $data);
			$this->load->view('v_footer');
		} else {
			date_default_timezone_set("Asia/Jakarta");
			$date = date('Y-m-d');
			$time = date('Y-m-d h:i:s');
			
			$this->load->library('upload');
			$signature = '';
			
			if(count($_FILES)>0){
			    if($_FILES['signature']['error']==0){
			        $config['upload_path']      = $_SERVER['DOCUMENT_ROOT'] . '/ui-master-update/upload/signature';
			        $config['allowed_types']    = 'png|jpg|jpeg';
			        $config['overwrite']        = FALSE;
			        $config['remove_spaces']    = TRUE;
			        $config['encrypt_name']     = TRUE;
			        $config['max_size']         = '1024';
			        
			        $this->upload->initialize($config);
			        
			        if(!$this->upload->do_upload('signature')){
			            $this->upload->display_errors();
			        }
			        else{
			            $signature = $this->upload->file_name;
			        }
			        
			    }
			}
			
			$data = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
			);
			
			if($signature != ''){
			    //hapus signature lalu
			    
			    $teacher = $this->db->get_where('teacher', array('id' => id));
			    
			    if($teacher->num_rows()!=0){
			        if($teacher->row()->signature!=''){
			            unlink($_SERVER['DOCUMENT_ROOT'] . 'ui/upload/signature/' . $teacher->row()->signature);
			        }
			    }
			    
			    $data['signature'] = $signature;
			}
			
			$latestRecordStudent = $this->mteacher->update($data, $id);
			$this->session->set_flashdata('success', "Update Teacher Success");
			redirect(base_url("teacher"));
		}
	}

	// not used

	public function destroy($id)
	{
	    $teacher = $this->db->get_where('teacher', array('id' => $id));
	    
	    if($teacher->num_rows()!=0){
	        if($teacher->row()->signature != ''){
	            unlink($_SERVER['DOCUMENT_ROOT'] . 'ui/upload/signature/' . $teacher->row()->signature);
	        }
	    }
	    
		$this->mteacher->destroy($id);
		redirect(base_url("teacher"));
	}

	public function activateUser($id)
	{
		 $data = array(
				'status' => 'nonactive',
				);
		 $where['id'] = $id;
		 $update = $this->mteacher->activateUser($data , $where);
		 if( $update ){
			$this->session->set_flashdata('alert','Teacher nonactivated successfully.');
		 }else{
			$this->session->set_flashdata('alert','Teacher nonactivated failed.');
		 }
		 redirect(base_url("Teacher"));

	}
}
