<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Student extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("mstudent");
		$this->load->model("mprice");
		$this->load->model("mpayment");
		$this->load->model("mpaydetail");
		$this->load->model("mvoucher");
		$this->load->model("mteacher");
		$this->load->model("mstaff");
		$this->load->model("MTrxAkuntansi");
		$this->load->model("MTrxAkuntansiDetail");
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		// echo "<pre>";
		// print_r($this->mstudent->getAllStudent()->result());
		$getStudent = $this->db->query("SELECT s.id as sid, s.priceid, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, s.note, s.branch_id, p.id, p.program, p.course, p.level , s.id_teacher, s.course_time, s.day1, s.day2  FROM student s INNER JOIN price p ON s.priceid = p.id  ORDER BY `sid` ASC");
		// print_r($asd->result());
		$data['listStudent'] = $getStudent;
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

		$birthday = $this->input->post('month') . " " . $this->input->post('date');


		$data = array(
			'branch_id' => $this->input->post('branch_id'),
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
		$mutasi = array(
			'student_id' => $this->input->post('id'),
			'price_id' => $this->input->post('programId'),
			'user_name' => $this->session->userdata('nama'),
			'from' => 'Payment',
			'created_at' => date('Y-m-d H:i:s', strtotime('+7 hours')),
			'updated_at' => date('Y-m-d H:i:s', strtotime('+7 hours')),
		);
		$this->mstudent->addMutasi($mutasi);
		$adjusment = $this->input->post('adjusment');
		$penalty = $this->input->post('penalty');
		$balance = $this->input->post('balance');

		$order   = array("Rp ", ".");
		$replace = "";

		$adjusment = str_replace($order, $replace, $adjusment);
		$penalty = str_replace($order, $replace, $penalty);
		$balance = str_replace($order, $replace, $balance);

		$birthday = $this->input->post('year') . " " . $this->input->post('month') . " " . $this->input->post('date');

		$data = array(
			'priceid' => $this->input->post('program'),
			'name' => $this->input->post('name'),
			'phone' => $this->input->post('phone'),
			'birthday' => $birthday,
			'adjusment' => $adjusment,
			'balance' => 0,
			'penalty' => 0,
			'status' => $this->input->post('status'),
			'condition' => $this->input->post('cond'),

			'note' => $this->input->post('note')

		);
		$program = $this->db->where('id', $this->input->post('program'))->get('price')->result();

		$id = $this->input->post('id');

		$data1 = array(
			'program' => $program[0]->program,
			'course' => $program[0]->course,
			'level' => $program[0]->level
		);
		$this->db->where('id_student', $id)->update('last_payment_regular', $data1);

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

		$birthday = $this->input->post('month') . " " . $this->input->post('date');

		if ($this->input->post('category') == "PRIVATE") {
			$program = $this->input->post('programprv');
		} else {
			$program = $this->input->post('program');
		}

		$data = array(
			'branch_id' => $this->input->post('branch_id'),
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
		if ($var != "") {
			$parts = explode('/', $var);
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
		if (isset($_POST['booklet'])) {
			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $latestRecordStudent['id'],
				'voucherid' => $this->input->post('vid'),
				'category' => "Booklet",
				//'monthpay' => $monthpay,
				'amount' => $this->input->post('vbooklet'),
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['others'])) {
			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $latestRecordStudent['id'],
				'voucherid' => $this->input->post('vid'),
				'category' => "OTHERS",
				//'monthpay' => $monthpay,
				'amount' => $this->input->post('vothers'),
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
				if ($discount != "") {
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
			redirect(base_url("escpos/example/printregisterprv.php?id=" . $latestRecordPayment['id']));
		} else {
			redirect(base_url("escpos/example/printregister.php?id=" . $latestRecordPayment['id']));
		}
		// redirect(base_url("escpos/example/printregister.php?id=".$id));
	}

	public function deleteStudentDb()
	{
		$id = $this->input->post('idstudent');
		$this->mstudent->deleteStudent($id);
		redirect(base_url("student"));
	}
	public function detailPayment($id, $name)
	{
		$data['name'] = $name;
		$data['listStudentPayment'] = $this->mstudent->getStudentDetailPayment($id);
		$this->load->view('v_header');
		$this->load->view('v_detail_payment', $data);
		$this->load->view('v_footer');
	}

	public function studentOnline()
	{
		$data['listStudent'] = $this->mstudent->getOnlineStudent();
		$data['listPrice'] = $this->mprice->getAllPrice();
		$data['listVoucher'] = $this->mvoucher->getAllVoucher();
		$data['teacher'] = $this->mteacher->index();
		$data['staff'] = $this->mstaff->index();
		$this->load->view('v_header');
		$this->load->view('v_studentlistonline', $data);
		$this->load->view('v_footer');
	}

	public function updateStudentOnline()
	{
		$var = $this->input->post('monthpay');
		$parts = explode('-', $var);
		//$montharr = date_parse($parts[0]);
		//if ($montharr['month'] < 10) {
		//	$month = "0" . $montharr['month'];
		//} else {
		//	$month = $montharr['month'];
		//}
		$monthpay = $parts[1] . '-' . $parts[0] . '-' . '1';

		//echo $monthpay;



		//exit();

		// var_dump($this->input->post());
		// die();



		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');
		$total = $this->input->post('amount');
		$order   = array("Rp ", ".");
		$replace = "";
		$total = str_replace($order, $replace, $total);
		$paycut = $this->input->post('paymentcut');
		$paycut = str_replace($order, $replace, $paycut);
		$day1 = "";
		$day2 = "";
		$coursetime = "";
		$branch_id = $this->input->post('branch_id');

		// date from input request
		$date = date_format(date_create($this->input->post('date')), "Y-m-d");

		if ($this->input->post('category') == "PRIVATE") {
			$program = $this->input->post('programprv');
			$day1 = $this->input->post('day1prv');
			$day2 = $this->input->post('day2prv');
			$coursetime = $this->input->post('timeprv') . " " . $this->input->post('ampmprv');
		} else {
			$program = $this->input->post('program');
			$day1 = $this->input->post('day1reg');
			$day2 = $this->input->post('day2reg');
			$coursetime = $this->input->post('timereg') . " " . $this->input->post('ampmreg');
		}

		$where['id'] = $this->input->post('idstudent');
		$form = array(
			'priceId' => $program,
			'is_complete' => '1',
			// 'day1' => $day1,
			// 'day2' => $day2,
			// 'course_time' => $coursetime,
			// 'id_teacher	' => $this->input->post('id_teacher'),
		);
		$this->mstudent->updateStudent($form, $where);

		// ambil id akun kas dari masing-masing cabang
		$akun_kas_id = null;
		if ($branch_id == '1') //jika cabang = Surabaya
			$akun_kas_id = 3;
		elseif ($branch_id == '2') //jika cabang = Bali
			$akun_kas_id = 4;

		//		ambil id akun bank dari masing-masing cabang
		$akun_bank_id = null;
		if ($branch_id == '1') //jika cabang = Surabaya
			$akun_bank_id = 6;
		elseif ($branch_id == '2') //jika cabang = Bali
			$akun_bank_id = 7;

		//		ambil id akun pendapatan dari masing-masing cabang
		$akun_pendapatan_id = null;
		if ($branch_id == '1') //jika cabang = Surabaya
			$akun_pendapatan_id = 10;
		elseif ($branch_id == '2') //jika cabang = Bali
			$akun_pendapatan_id = 11;

		// $var = $this->input->post('trfdate');
		$var = trim($this->input->post('date'));

		if (!empty($var) && $this->input->post('method') == 'BANK TRANSFER') {
			$parts = explode('-', $var); // Ubah pemisah dari '/' ke '-'

			if (count($parts) === 3) {
				$trfdate = $parts[0] . '-' . $parts[1] . '-' . $parts[2]; // Tetap dalam format YYYY-MM-DD
			} else {
				$trfdate = null; // Jika format salah, atur ke null
			}
		} else {
			$trfdate = null;
		}
		if ($var != "") {
			// $parts = explode('/', $var);
			// $trfdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
			$data = array(
				'paydate' => $date,
				'paytime' => $time,
				'method' => $this->input->post('method'),
				'number' => $this->input->post('number'),
				'bank' => $this->input->post('bank'),
				'total' => $total - $paycut,
				'trfdate' => $trfdate,
				'username' => $this->session->userdata('nama'),
				'branch_id' => $this->input->post('branch_id'),
			);
			$latestRecordPayment = $this->mpayment->addPayment($data);

			//input journal
			//		simpan transaksi jurnal
			$data_trx_akuntansi = array(
				'payment_id' => $latestRecordPayment['id'],
				'deskripsi' => 'Income from payment id ' . $latestRecordPayment['id'],
				'tanggal' => $date,
				'branch_id' => $branch_id,
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_trx_akuntansi = $this->MTrxAkuntansi->addTrxAkuntansi($data_trx_akuntansi);

			//		simpan transaksi ke detail jurnal
			$data_akun_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $this->input->post('method') == 'CASH' ? $akun_kas_id : $akun_bank_id,
				'jumlah' => $total - $paycut,
				'tipe' => 'DEBIT',
				'keterangan' => 'akun',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->MTrxAkuntansiDetail->addTrxAkuntansiDetail($data_akun_trx_akuntansi_detail);

			$data_lawan_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $akun_pendapatan_id,
				'jumlah' => $total - $paycut,
				'tipe' => 'KREDIT',
				'keterangan' => 'lawan',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->MTrxAkuntansiDetail->addTrxAkuntansiDetail($data_lawan_trx_akuntansi_detail);
		} else {
			$data = array(
				'paydate' => $date,
				'paytime' => $time,
				'method' => $this->input->post('method'),
				'number' => $this->input->post('number'),
				'bank' => $this->input->post('bank'),
				'total' => $total - $paycut,
				'username' => $this->session->userdata('nama'),
				'branch_id' => $this->input->post('branch_id'),
			);
			$latestRecordPayment = $this->mpayment->addPayment($data);

			//input journal
			//		simpan transaksi jurnal
			$data_trx_akuntansi = array(
				'payment_id' => $latestRecordPayment['id'],
				'deskripsi' => 'Income from payment id ' . $latestRecordPayment['id'],
				'tanggal' => $date,
				'branch_id' => $branch_id,
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_trx_akuntansi = $this->MTrxAkuntansi->addTrxAkuntansi($data_trx_akuntansi);

			//		simpan transaksi ke detail jurnal
			$data_akun_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $this->input->post('method') == 'CASH' ? $akun_kas_id : $akun_bank_id,
				'jumlah' => $total - $paycut,
				'tipe' => 'DEBIT',
				'keterangan' => 'akun',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->MTrxAkuntansiDetail->addTrxAkuntansiDetail($data_akun_trx_akuntansi_detail);

			$data_lawan_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $akun_pendapatan_id,
				'jumlah' => $total - $paycut,
				'tipe' => 'KREDIT',
				'keterangan' => 'lawan',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->MTrxAkuntansiDetail->addTrxAkuntansiDetail($data_lawan_trx_akuntansi_detail);
		}

		if (isset($_POST['registration'])) {
			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $this->input->post('idstudent'),
				'voucherid' => $this->input->post('vid'),
				'category' => "REGISTRATION",
				'monthpay' => $monthpay,
				'amount' => $this->input->post('vregistration'),
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['pointbook'])) {
			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $this->input->post('idstudent'),
				'voucherid' => $this->input->post('vid'),
				'category' => "POINT BOOK",
				'monthpay' => $monthpay,
				'amount' => $this->input->post('vpointbook'),
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['book'])) {
			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $this->input->post('idstudent'),
				'voucherid' => $this->input->post('vid'),
				'category' => "BOOK",
				'monthpay' => $monthpay,
				'amount' => $this->input->post('vbook'),
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['agenda'])) {
			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $this->input->post('idstudent'),
				'voucherid' => $this->input->post('vid'),
				'category' => "AGENDA",
				'monthpay' => $monthpay,
				'amount' => $this->input->post('vagenda'),
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if (isset($_POST['booklet'])) {
			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $this->input->post('idstudent'),
				'voucherid' => $this->input->post('vid'),
				'category' => "BOOKLET",
				'monthpay' => $monthpay,
				'amount' => $this->input->post('vbooklet'),
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}
		if ($this->input->post('category') == "PRIVATE") {
			$exAttendance = explode(',', $_POST['attendance']);
			$countattn = count($exAttendance);
			$attendance = $_POST['attendance'];
			$priceattn = $this->input->post('priceattn');
			$order   = array("Rp ", ".");
			$replace = "";
			$priceattn = str_replace($order, $replace, $priceattn);
			$discount = $this->input->post('discount');

			//2023-12-28
			$amount = $this->input->post('amount');
			$amount = str_replace($order, $replace, $amount);

			$explanation = '(' . $attendance . ')' . ' ' . $countattn . 'x' . $priceattn;
			if ($discount != "") {
				$explanation = $explanation . '-' . $discount . '%';
			}

			$data = array(
				'paymentid' => $latestRecordPayment['id'],
				'studentid' => $this->input->post('idstudent'),
				'voucherid' => $this->input->post('vid'),
				'category' => "COURSE",
				'explanation' => $explanation,
				'amount' => $amount //$total - $paycut
			);
			// var_dump($data);
			$var = $this->mpaydetail->addPaydetail($data);
		} else {
			if (isset($_POST['course'])) {

				//$var = $this->input->post('monthpay');
				//$parts = explode(' ', $var);
				//$montharr = date_parse($parts[0]);
				//if ($montharr['month'] < 10) {
				//	$month = "0" . $montharr['month'];
				//} else {
				//	$month = $montharr['month'];
				//}
				//$monthpay = $parts[1] . '-' . $month . '-' . '1';

				//$amount = $this->input->post('amount');
				//$order   = array("Rp ", ".");
				//$replace = "";
				//$amount = str_replace($order, $replace, $amount);


				$countattn = $this->input->post('countattn');
				$attendance = $this->input->post('attendancereg');
				$priceattn = $this->input->post('priceattnreg');
				$order   = array("Rp ", ".");
				$replace = "";
				$priceattn = str_replace($order, $replace, $priceattn);
				$discount = $this->input->post('discount');

				$explanation = '(' . $attendance . ')' . ' ' . $countattn . 'x' . $priceattn;
				if ($discount != "") {
					$explanation = $explanation . '-' . $discount . '%';
				}
				$exRegMonth = explode('-', $date);
				$data = array(
					'paymentid' => $latestRecordPayment['id'],
					'studentid' => $this->input->post('idstudent'),
					'voucherid' => $this->input->post('vid'),
					'category' => "COURSE",
					'monthpay' => $monthpay, //$date,
					'explanation' => $explanation,
					'amount' => $this->input->post('vcourse'),
				);
				$var = $this->mpaydetail->addPaydetail($data);

				$paymentReg = array(
					"total_price" => $this->input->post('vcourse'),
					'class_type' => 'Reguler',
					'created_by' => $this->session->userdata('nama'),
					'updated_by' => $this->session->userdata('nama'),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				);
				$lastIdReg = $this->mpayment->addPaymentReg($paymentReg);

				$paymentRegDet = array(
					'id_payment_bill' => $lastIdReg['id'],
					'student_id' => $this->input->post('idstudent'),
					'category' => 'COURSE',
					'price' => $this->input->post('vcourse'),
					'payment' => 'COURSE'  . ' ' . $exRegMonth[1] . '-' . $exRegMonth[0],
					'status' => 'Paid',
					'unique_code' => $latestRecordPayment['id'],
				);
				$this->mpayment->addPaymentRegDetail($paymentRegDet);
			}
		}
		if ($this->input->post('category') == "PRIVATE") {
			sleep(2);
			redirect(base_url("payment/addprivate?print=" . $latestRecordPayment['id']));
		} else {
			sleep(2);
			redirect(base_url("payment/addregular?print=" . $latestRecordPayment['id']));
		}
	}

	public function resultTest()
	{
		$where['id'] = $this->input->post('idstudent');
		$form = array(
			'id_staff' => $this->input->post('staff'),
			'id_teacher' => $this->input->post('id_teacher'),
			'kind_of_test' => $this->input->post('kind_of_test'),
			'date_test' => date("Y-m-d"),
		);
		$this->mstudent->updateStudent($form, $where);
		redirect(base_url('student/studentOnline'));
	}

	public function sendWa($number, $message)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => 'https://wa.primtech-api.com/send-message',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => 'api_key=2e4f34588aeb869e3282ad49004dcc9c&sender=6285236432780&number=' . $number . '&message=' . $message,
			CURLOPT_HTTPHEADER => array(
				'Content-Type: application/x-www-form-urlencoded'
			),
		));

		$response = curl_exec($curl);

		curl_close($curl);
		echo $response;
	}

	public function send()
	{
		$form = $this->input->post('sendwa');
		foreach ($form as $key => $value) {
			$arrForm = explode(".", $value);
			$id = $arrForm[0];
			$date = $arrForm[1];
			$arrDate = explode(" ", $date);
			$student = $this->mstudent->getStudentById($id)->row();
			$phone = (int)$student->phone;
			$cekNo = substr((int)$student->phone, 0, 2);
			$lastDate = date("Y-m-t", strtotime($arrDate[0]));
			$exLastDate = explode("-", $lastDate);
			$nextMonth = date('F', strtotime('+1 month', strtotime($arrDate[0])));
			$nextMonthDay = $this->dayIndo(date('D', strtotime('+1 month', strtotime($arrDate[0]))));
			if ($cekNo != '62') {
				$number = (int)(62 . $phone);
			} else {
				$number = $phone;
			}
			$message = 'Selamat sore%0a%0aMau mengingatkan segera lakukan pembayaran spp ' . $nextMonth . ' ' . $student->name . ' sebesar 300.000%2Forang%0a%0a• Pembayaran melalui Frontdesk U%26I  terakhir hari ' . $nextMonthDay . '  tgl *' . $exLastDate[2] . ' ' . $nextMonth . ' ' . $exLastDate[0] . '*%0a• Pembayaran melalui Transfer BCA 464 1327 187 an Lie Citro Dewi Ruslie terakhir tgl *31 ' . $nextMonth . '* ' . $exLastDate[0] . '%0a• *Pembayaran lebih dari tgl ' . $exLastDate[2] . ' ' . $nextMonth . ' ' . $exLastDate[0] . ' akan dikenakan denda keterlambatan sebesar 10%25*🙂🙏🏻%0a%0aTerima kasih 🙂🙏🏻';
			$this->sendwa($number, $message);
		}
		echo $message;
		redirect(base_url('report/showLate'));
	}

	public function getPrice($id)
	{
		$price = $this->mprice->getPriceById($id);
		echo json_encode($price->result());
	}

	public function updateInactive()
	{
		$student = $this->mstudent->getInactiveStudent();
		foreach ($student->result() as $key => $value) {
			$where = $value->studentid;
			$this->db->where('id', $where);
			$this->db->update('student', array('status' => 'INACTIVE'));
		}
	}

	public function exportStudentOnline()
	{
		// fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");

		// membuat nama file ekspor "export-to-excel.xls"
		header("Content-Disposition: attachment; filename=U&I Prospective Student.xls");
		$data['listStudent'] = $this->mstudent->getOnlineStudent();
		$data['listPrice'] = $this->mprice->getAllPrice();
		$this->load->view('v_exportprospectivestudent', $data);
	}

	public function dayIndo($day)
	{
		$hari = '';
		if ($day == 'Mon') {
			$hari = 'Senin';
		} else if ($day == 'Tue') {
			$hari = 'Selasa';
		} else if ($day == 'Wed') {
			$hari = 'Rabu';
		} else if ($day == 'Thu') {
			$hari = 'Kamis';
		} else if ($day == 'Fri') {
			$hari = 'Jumat';
		} else if ($day == 'Sat') {
			$hari = 'Sabtu';
		} else if ($day == 'Sun') {
			$hari = 'Minggu';
		}
		return $hari;
	}

	public function updateProspective($id)
	{
		$this->db->where('id', $id);
		$this->db->update('student', array('is_prospective_done' => '1'));
		redirect(base_url('student/studentOnline'));
	}

	public function activateStudent($id, $status)
	{

		if ($status == 'ACTIVE') {
			$setStatus = 'INACTIVE';
			$message = 'deactivated successfully';
		} elseif ($status == 'INACTIVE') {
			$setStatus = 'ACTIVE';
			$message = 'activated successfully';
		} else {
			$setStatus = 'NO clue';
		}

		$this->db->where('id', $id);
		$proses = $this->db->update('student', array('status' => $setStatus));
		if ($proses) {
			$msg = $message;

			// Ambil data dari form
			$program = $this->input->post('program');
			// $name = $this->input->post('name');
			$review_id = $this->input->post('review_id');
			$id_teacher = $this->input->post('id_teacher');
			$date_inactive = $this->input->post('date');
			$explanation = $this->input->post('explanation');
			$created_at = date('Y-m-d H:i:s');


			// Cek apakah program tidak null
			if ($program != null) {
				// Persiapkan data untuk disimpan ke database
				$data = [
					'student_id' => $id,
					'program' => $program,
					// 'name' => $name,
					'review_id' => $review_id,
					'teacher_id' => $id_teacher ? $id_teacher : 0,
					'date_inactive' => $date_inactive,
					'explanation' => $explanation,
					'created_at' => $created_at
				];

				// Simpan data ke tabel student_review
				$this->db->insert('student_review', $data);

				// Cek apakah data berhasil disimpan
				if ($this->db->affected_rows() > 0) {
					// Berikan respon sukses
					$msg = "Data successfully saved to database.";
				} else {
					// Berikan respon jika gagal
					$msg = "Failed to save data. Please try again.";
				}
			} else {
				$msg = "Activate successfully";
			}
		} else {
			$msg = 'failed';
		}

		$this->session->set_flashdata('alert', $msg);
		redirect(base_url('student'));
	}

	public function latepayment()
	{
		$data['listStudent'] = $this->mstudent->getStudentLatePayment();
		// 		echo '<pre style="background-color: #f4f4f4; color: #333; padding: 10px; border: 1px solid #ddd; border-radius: 5px; font-size: 14px; line-height: 1.5; overflow: auto;">';
		// var_dump($data['listStudent']);
		// echo '</pre>';
		// die();

		$this->load->view('v_header');
		$this->load->view('v_latepayment', $data);
		$this->load->view('v_footer');
	}

	public function student_review()
	{
		$data['listStudentReview'] = $this->mstudent->getStudentReview();

		$this->load->view('v_header');
		$this->load->view('v_student_review', $data);
		$this->load->view('v_footer');
	}
}
