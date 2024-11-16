<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("mstudent");
		$this->load->model("mprice");
		$this->load->model("mpayment");
		$this->load->model("mpaydetail");
		$this->load->model("mvoucher");
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$data['listStudent'] = $this->mstudent->getAllStudent();
		$data['listStudentPayment'] = $this->mstudent->getStudentPayment();
		$this->load->view('v_header');
		$this->load->view('v_studentlist', $data);
		$this->load->view('v_footer');
	}

	public function addStudent()
	{
		$data['listPrice'] = $this->mprice->getAllPrice();
		$this->load->view('v_header');
		$this->load->view('v_studentadd', $data);
		$this->load->view('v_footer');
	}

	public function addStudentDb()
	{
		$date = date('Y-m-d');

		$adjusment = $this->input->post('adjusment');
		$penalty = $this->input->post('penalty');
		$balance = $this->input->post('balance');

		$order   = array("Rp ", ".");
		$replace = "";

		$adjusment = str_replace($order, $replace, $adjusment);
		$penalty = str_replace($order, $replace, $penalty);
		$balance = str_replace($order, $replace, $balance);

		$birthday = $this->input->post('month')." ".$this->input->post('date');

		$data = array(
				'priceid' => $this->input->post('program'),
				'name' => $this->input->post('name'),
				'phone' => $this->input->post('phone'),
				'birthday' => $birthday,
				'entrydate' => $date,
				'adjusment' => $adjusment,
				'balance' => 0,
				'penalty' => 0,
				'status' => $this->input->post('status'),
				'condition' => $this->input->post('cond')
				);
		$latestRecord = $this->mstudent->addStudent($data);

		redirect(base_url("student"));
	}

	public function updateStudent($id)
	{
		$data['student'] = $this->mstudent->getStudentById($id);
		$data['listPrice'] = $this->mprice->getAllPrice();

		$this->load->view('v_header');
		$this->load->view('v_studentedit', $data);
		$this->load->view('v_footer');
	}

	public function updateStudentDb()
	{
		$adjusment = $this->input->post('adjusment');
		$penalty = $this->input->post('penalty');
		$balance = $this->input->post('balance');

		$order   = array("Rp ", ".");
		$replace = "";

		$adjusment = str_replace($order, $replace, $adjusment);
		$penalty = str_replace($order, $replace, $penalty);
		$balance = str_replace($order, $replace, $balance);

		$birthday = $this->input->post('month')." ".$this->input->post('date');

		$data = array(
				'priceid' => $this->input->post('program'),
				'name' => $this->input->post('name'),
				'phone' => $this->input->post('phone'),
				'birthday' => $birthday,
				'adjusment' => $adjusment,
				'balance' => 0,
				'penalty' => 0,
				'status' => $this->input->post('status'),
				'condition' => $this->input->post('cond')
				);

		$where['id'] = $this->input->post('id');
		$this->mstudent->updateStudent($data, $where);

		redirect(base_url("student"));
	}

	public function register()
	{
		$data['listPrice'] = $this->mprice->getAllPrice();
		$data['listVoucher'] = $this->mvoucher->getAllVoucher();
		$this->load->view('v_header');
		$this->load->view('v_register', $data);
		$this->load->view('v_footer');
	}

	public function registerDb()
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');

		$birthday = $this->input->post('month')." ".$this->input->post('date');

		if ($this->input->post('category') == "PRIVATE") {
			$program = $this->input->post('programprv');
		} else {
			$program = $this->input->post('program');
		}

		$data = array(
				'priceid' => $program,
				'name' => $this->input->post('name'),
				'phone' => $this->input->post('phone'),
				'birthday' => $birthday,
				'entrydate' => $date,
				'adjusment' => 0,
				'balance' => 0,
				'penalty' => 0,
				'status' => "ACTIVE",
				'condition' => "DEFAULT"
				);
		$latestRecordStudent = $this->mstudent->addStudent($data);

		$total = $this->input->post('amount');
		$order   = array("Rp ", ".");
		$replace = "";
		$total = str_replace($order, $replace, $total);

		$var = $this->input->post('trfdate');
		if($var != "") {
			$parts = explode('/',$var);
			$trfdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$data = array(
					'paydate' => $date,
					'paytime' => $time,
					'method' => $this->input->post('method'),
					'number' => $this->input->post('number'),
					'bank' => $this->input->post('bank'),
					'total' => $total,
					'trfdate' => $trfdate,
					'username' => $this->session->userdata('nama')
					);
			$latestRecordPayment = $this->mpayment->addPayment($data);
		} else {
			$data = array(
					'paydate' => $date,
					'paytime' => $time,
					'method' => $this->input->post('method'),
					'number' => $this->input->post('number'),
					'bank' => $this->input->post('bank'),
					'total' => $total,
					'username' => $this->session->userdata('nama')
					);
			$latestRecordPayment = $this->mpayment->addPayment($data);
		}

		if (isset($_POST['registration'])) {
			$data = array(
					'paymentid' => $latestRecordPayment['id'],
					'studentid' => $latestRecordStudent['id'],
					'voucherid' => $this->input->post('vid'),
					'category' => "REGISTRATION",
					//'monthpay' => $monthpay,
					'amount' => $this->input->post('vregistration'),
					);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['pointbook'])) {
			$data = array(
					'paymentid' => $latestRecordPayment['id'],
					'studentid' => $latestRecordStudent['id'],
					'voucherid' => $this->input->post('vid'),
					'category' => "POINT BOOK",
					//'monthpay' => $monthpay,
					'amount' => $this->input->post('vpointbook'),
					);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['book'])) {
			$data = array(
					'paymentid' => $latestRecordPayment['id'],
					'studentid' => $latestRecordStudent['id'],
					'voucherid' => $this->input->post('vid'),
					'category' => "BOOK",
					//'monthpay' => $monthpay,
					'amount' => $this->input->post('vbook'),
					);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['agenda'])) {
			$data = array(
					'paymentid' => $latestRecordPayment['id'],
					'studentid' => $latestRecordStudent['id'],
					'voucherid' => $this->input->post('vid'),
					'category' => "AGENDA",
					//'monthpay' => $monthpay,
					'amount' => $this->input->post('vagenda'),
					);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['course'])) {
			if ($this->input->post('category') == "PRIVATE") {
				$countattn = $this->input->post('countattn');
				$attendance = $this->input->post('attendance');
				$priceattn = $this->input->post('priceattn');
				$order   = array("Rp ", ".");
				$replace = "";
				$priceattn = str_replace($order, $replace, $priceattn);
				$discount = $this->input->post('discount');

				$explanation = '(' . $attendance . ')' . ' ' . $countattn . 'x' . $priceattn;
				if($discount != "") {
					$explanation = $explanation . '-' . $discount . '%';
				}

				$data = array(
						'paymentid' => $latestRecordPayment['id'],
						'studentid' => $latestRecordStudent['id'],
						'voucherid' => $this->input->post('vid'),
						'category' => "COURSE",
						'explanation' => $explanation,
						'amount' => $this->input->post('vcourse')
						);
				$var = $this->mpaydetail->addPaydetail($data);
			} else {
				$data = array(
						'paymentid' => $latestRecordPayment['id'],
						'studentid' => $latestRecordStudent['id'],
						'voucherid' => $this->input->post('vid'),
						'category' => "COURSE",
						'monthpay' => $date,
						'amount' => $this->input->post('vcourse'),
						);
				$var = $this->mpaydetail->addPaydetail($data);
			}
		}

		// redirect(base_url("student/register"));
		if ($this->input->post('category') == "PRIVATE") {
			// redirect(base_url("escpos/example/printregisterprv.php?id=".$latestRecordPayment['id']));
			redirect(base_url("student/register?print=".$latestRecord['id']));
		} else {
			// redirect(base_url("escpos/example/printregister.php?id=".$latestRecordPayment['id']));
			redirect(base_url("student/register?print=".$latestRecord['id']));
		}
		// redirect(base_url("escpos/example/printregister.php?id=".$id));
	}

	public function deleteStudentDb($id)
	{
		$this->mstudent->deleteStudent($id);
		redirect(base_url("student"));
	}
}
?>
