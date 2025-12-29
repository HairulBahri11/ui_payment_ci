<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class OnlineRegistration extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("mstudent");
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('v_register_online');
	}

	public function store()
	{
		$this->form_validation->set_rules('signature', 'signature', 'required');
		$this->form_validation->set_rules(
			'phone',
			'phone',
			'required|max_length[14]',
			array(
				'max_length'      => 'Max phone number is 14 digit',
			)
		);
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('v_register_online');
		} else {
			date_default_timezone_set("Asia/Jakarta");
			$date = date('Y-m-d');
			$time = date('Y-m-d h:i:s');

			$birthday = $this->input->post('year') . " " . $this->input->post('month') . " " . $this->input->post('date');
			$folderPath = "upload/signature/";

			$image_parts = explode(";base64,", $_POST['signature']);

			$image_type_aux = explode("image/", $image_parts[0]);

			$image_type = $image_type_aux[1];

			$image_base64 = base64_decode($image_parts[1]);

			$file = $folderPath . uniqid() . '.' . $image_type;

			file_put_contents($file, $image_base64);
			$data = array(
				'name' => $this->input->post('name'),
				'phone' => '62' . $this->input->post('phone'),
				'address' => $this->input->post('address'),
				'school' => $this->input->post('school'),
				'grade' => $this->input->post('grade'),
				'birthday' => $birthday,
				'entrydate' => $date,
				'adjusment' => 0,
				'balance' => 0,
				'penalty' => 0,
				'status' => "ACTIVE",
				'condition' => "DEFAULT",
				'is_online' => true,
				'is_complete' => '0',
				'know' => $this->input->post('know') != 'Other' ? $this->input->post('know') : $this->input->post('others'),
				'signature' => $file,
				'branch_id' => $this->input->post('branch_id') ? $this->input->post('branch_id') : 1
			);
			$dataParent = [
				'name' => $this->input->post('parent_name'),
				'no_hp' => $this->input->post('phone'),
			];
			$this->db->insert('student', $data);
			$lastIdData = $this->db->insert_id();
			$this->db->insert('parents', $dataParent);
			$lastIdDataParent = $this->db->insert_id();
			$dataParentStudent = [
				'parent_id' => $lastIdDataParent,
				'student_id' => $lastIdData,
			];
			$this->db->insert('parent_students', $dataParentStudent);
			// $latestRecordStudent = $this->mstudent->addStudent($data);
			$this->session->set_flashdata('success', "Registration Success");
			redirect(base_url("OnlineRegistration"));
		}
	}
}
