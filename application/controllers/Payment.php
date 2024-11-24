<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Payment extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model("mpayment");
		$this->load->model("mstudent");
		$this->load->model("mprice");
		$this->load->model("mvoucher");
		$this->load->model("mpaydetail");
		$this->load->model("mtrxakuntansi");
		$this->load->model("mtrxakuntansidetail");
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("user"));
		}
	}

	public function index() {}

	public function addRegular()
	{
		$listLateStudent = $this->mstudent->getLatePaymentStudent();
		foreach ($listLateStudent as $student) {
			$monthpay = date("m", strtotime($student->monthpay));
			if (($monthpay < date('m')) || ($student->monthpay == '')) {
				if ($student->condition == "DEFAULT") {
					$data = array(
						'penalty' => ($student->course * 10 / 100)
					);
				} else {
					$data = array(
						'penalty' => ($student->adjusment * 10 / 100)
					);
				}
				$where['id'] = $student->id;
				$this->mstudent->updateStudent($data, $where);
			} else {
				$data = array(
					'penalty' => 0
				);
				$where['id'] = $student->id;
				$this->mstudent->updateStudent($data, $where);
			}
		}

		$listUncomplete = $this->mpayment->getUncompletePayment();
		foreach ($listUncomplete as $uncomplete) {
			$listVoucher = $this->mpayment->getUncompleteVoucher($uncomplete->id);
			foreach ($listVoucher as $voucher) {
				$data = array(
					'isused' => "YES"
				);
				$where['id'] = $voucher->voucherid;
				$this->mvoucher->updateVoucher($data, $where);
			}
			$this->mpayment->deletePayment($uncomplete->id);
			$this->mpaydetail->deletePaydetailByPaymentId($uncomplete->id);
		}

		$data['listStudent'] = $this->mstudent->getAllRegular()->result();

		$data['allStudent'] = array();
		foreach ($data['listStudent'] as $key => $value) {
			$row = array();
			$row['sid'] = $value->sid;
			$row['priceid'] = $value->priceid;
			$row['name'] = $value->name;
			$row['program'] = $value->program;
			$row['phone'] = $value->phone;
			$row['branch_id'] = $value->branch_id;
			if ($value->condition == "DEFAULT") {
				$row['course'] = '<span class="badge bg-yellow">Default: Rp ' . number_format($value->course, 0, ".", ".") . '</span>';
			} elseif ($value->condition == "CHANGE") {
				$row['course'] = '<span class="badge bg-light-blue">Change: Rp ' . number_format($value->course, 0, ".", ".") . '</span>';
			} else {
				$row['course'] = '-';
			}
			$data['allStudent'][] = $row;
		}
		// $output = array(
		//         "draw" => 0,
		//         "recordsTotal" => count($data1),
		//         "recordsFiltered" => count($data1),
		//         "data" => $data1,
		// );
		// 		echo "<pre>";
		// 		print_r($data['allStudent']);
		// 		echo "</pre>";
		$data['listPrice'] = $this->mprice->getAllPrice();
		$data['listVoucher'] = $this->mvoucher->getAllVoucherYes();
		// $data['listPaydetail'] = $this->mpaydetail->getPaydetailByPaymentId($latestRecord['id']);
		$this->load->view('v_header');
		$this->load->view('v_regularadd', $data);
		$this->load->view('v_footer');
	}
	public function getStudentRegular()
	{
		$data = $this->mstudent->getAllRegular()->result();
		$data1 = array();
		foreach ($data as $key => $value) {
			$row = array();
			$row['sid'] = $value->sid;
			$row['priceid'] = $value->priceid;
			$row['name'] = $value->name;
			$row['program'] = $value->program;
			if ($value->condition == "DEFAULT") {
				$row['course'] = '<span class="badge bg-yellow">Default: Rp ' . number_format($value->course, 0, ".", ".") . '</span>';
			} elseif ($value->condition == "CHANGE") {
				$row['course'] = '<span class="badge bg-light-blue">Change: Rp ' . number_format($value->adjusment, 0, ".", ".") . '</span>';
			} else {
				$row['course'] = '-';
			}
			$data1[] = $row;
		}
		$output = array(
			"draw" => 0,
			"recordsTotal" => count($data1),
			"recordsFiltered" => count($data1),
			"data" => $data1,
		);
		header('Content-Type: application/json');
		echo json_encode($output);
	}

	public function addPrivate()
	{
		$listUncomplete = $this->mpayment->getUncompletePayment();
		foreach ($listUncomplete as $uncomplete) {
			$listVoucher = $this->mpayment->getUncompleteVoucher($uncomplete->id);
			foreach ($listVoucher as $voucher) {
				$data = array(
					'isused' => "YES"
				);
				$where['id'] = $voucher->voucherid;
				$this->mvoucher->updateVoucher($data, $where);
			}
			$this->mpayment->deletePayment($uncomplete->id);
			$this->mpaydetail->deletePaydetailByPaymentId($uncomplete->id);
		}

		$data['listStudent'] = $this->mstudent->getAllPrivate();
		$data['listPrice'] = $this->mprice->getAllPrice();
		$data['listVoucher'] = $this->mvoucher->getAllVoucherYes();
		// $data['listPaydetail'] = $this->mpaydetail->getPaydetailByPaymentId($latestRecord['id']);


		$this->load->view('v_header');
		$this->load->view('v_privateadd', $data);
		$this->load->view('v_footer');
	}

	public function addOther()
	{
		$listLateStudent = $this->mstudent->getLatePaymentStudent();
		foreach ($listLateStudent as $student) {
			$monthpay = date("m", strtotime($student->monthpay));
			if (($monthpay < date('m')) || ($student->monthpay == '')) {
				if ($student->condition == "DEFAULT") {
					$data = array(
						'penalty' => ($student->course * 10 / 100)
					);
				} else {
					$data = array(
						'penalty' => ($student->adjusment * 10 / 100)
					);
				}
				$where['id'] = $student->id;
				$this->mstudent->updateStudent($data, $where);
			} else {
				$data = array(
					'penalty' => 0
				);
				$where['id'] = $student->id;
				$this->mstudent->updateStudent($data, $where);
			}
		}

		$listUncomplete = $this->mpayment->getUncompletePayment();
		foreach ($listUncomplete as $uncomplete) {
			$this->mpayment->deletePayment($uncomplete->id);
			$this->mpaydetail->deletePaydetailByPaymentId($uncomplete->id);
		}

		$data['listStudent'] = $this->mstudent->getAllActive();
		$data['listPrice'] = $this->mprice->getAllPrice();
		// $data['listPaydetail'] = $this->mpaydetail->getPaydetailByPaymentId($latestRecord['id']);
		$this->load->view('v_header');
		$this->load->view('v_otheradd', $data);
		$this->load->view('v_footer');
	}

	public function addRegularDb()
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');

		$total = $this->input->post('total');
		$total_penalty = $this->input->post('total_penalty');
		$order   = array("Rp ", ".");
		$replace = "";
		$total = str_replace($order, $replace, $total);
		$total_penalty = str_replace($order, $replace, $total_penalty);

		$other_detail = $this->input->post('other_detail');

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
			$latestRecord = $this->mpayment->addPayment($data);
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
			$latestRecord = $this->mpayment->addPayment($data);
		}

		$recordnum = $this->input->post('recordnum');
		for ($i = 1; $i <= $recordnum; $i++) {
			$amount = $this->input->post('amount' . $i);
			$order   = array("Rp ", ".");
			$replace = "";
			$amount = str_replace($order, $replace, $amount);

			if ($this->input->post('payment' . $i) == "COURSE") {
				$var = $this->input->post('month' . $i);
				$parts = explode(' ', $var);
				$montharr = date_parse($parts[0]);
				if ($montharr['month'] < 10) {
					$month = "0" . $montharr['month'];
				} else {
					$month = $montharr['month'];
				}
				$monthpay = $parts[1] . '-' . $month . '-' . '1';
			}

			if ($this->input->post('voucher' . $i) != "") {
				$data = array(
					'isused' => "NO"
				);
				$where['id'] = $this->input->post('voucher' . $i);
				$this->mvoucher->updateVoucher($data, $where);
			}
			$exRegMonth = explode('-', $monthpay);
			// echo '<pre>';
			if ($this->input->post('payment' . $i) == "COURSE") {
				// $regularBill = $this->mpayment->getPaymentReg($this->input->post('studentid' . $i));
				$regularBill = $this->mpayment->getPaymentReg($this->input->post('studentid' . $i),  $exRegMonth[0], $exRegMonth[1]);
				$retRegularBill = $regularBill;
				$exRegBill = null;
				// 	$data = array(
				// 		'paymentid' => $latestRecord['id'],
				// 		'studentid' => $this->input->post('studentid' . $i),
				// 		'voucherid' => $this->input->post('voucher' . $i),
				// 		'category' => $this->input->post('payment' . $i),
				// 		'monthpay' => $monthpay,
				// 		'amount' => $amount
				// 	);
				// 	$var = $this->mpaydetail->addPaydetail($data);
				// } else {
				// 	$data = array(
				// 		'paymentid' => $latestRecord['id'],
				// 		'studentid' => $this->input->post('studentid' . $i),
				// 		'voucherid' => $this->input->post('voucher' . $i),
				// 		'category' => $this->input->post('payment' . $i),
				// 		'amount' => $amount
				// 	);
				// 	$var = $this->mpaydetail->addPaydetail($data);
				// }
				// print_r($retRegularBill[0]->payment);
				// // print_r($retRegularBill);
				// print_r($exRegMonth);
				// print_r($this->input->post('month' . $i));
				// print_r($this->input->post('studentid' . $i));
				if ($retRegularBill != null) {
					$exRegBill = explode(' ', $retRegularBill[0]->payment);
					if ($exRegBill[1] == $exRegMonth[1] . '-' . $exRegMonth[0]) {
						print_r('ccd');
						$data = array(
							'paymentid' => $latestRecord['id'],
							'studentid' => $this->input->post('studentid' . $i),
							'voucherid' => $this->input->post('voucher' . $i),
							'category' => $this->input->post('payment' . $i),
							'monthpay' => $monthpay,
							'amount' => $amount,
						);

						// Tambahkan nilai 'other_detail' jika kategori adalah "OTHER"
						if ($this->input->post('payment' . $i) == "OTHER") {
							$data['other_detail'] = $other_detail;
						}
						$var = $this->mpaydetail->addPaydetail($data);
						$regPay = array(
							'status' => 'Paid',
							'unique_code' => $latestRecord['id'],
						);
						$historyRegPay = array(
							'unique_code' => $latestRecord['id'],
						);
						$this->mpayment->updateHistyoryReg($historyRegPay, $retRegularBill[0]->unique_code);
						$this->mpayment->updatePaymentReg($regPay, $this->input->post('studentid' . $i), $this->input->post('payment' . $i), $retRegularBill[0]->payment);
					} else {
						$data = array(
							'paymentid' => $latestRecord['id'],
							'studentid' => $this->input->post('studentid' . $i),
							'voucherid' => $this->input->post('voucher' . $i),
							'category' => $this->input->post('payment' . $i),
							'monthpay' => $monthpay,
							'amount' => $amount,

						);
						// Tambahkan nilai 'other_detail' jika kategori adalah "OTHER"
						if ($this->input->post('payment' . $i) == "OTHER") {
							$data['other_detail'] = $other_detail;
						}
						$var = $this->mpaydetail->addPaydetail($data);
						$paymentReg = array(
							"total_price" => $amount,
							'class_type' => 'Reguler',
							'created_by' => $this->session->userdata('nama'),
							'updated_by' => $this->session->userdata('nama'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
						);
						$lastIdReg = $this->mpayment->addPaymentReg($paymentReg);
						$paymentRegDet = array(
							'id_payment_bill' => $lastIdReg['id'],
							'student_id' => $this->input->post('studentid' . $i),
							'category' => $this->input->post('payment' . $i),
							'price' => $amount,
							'payment' => $this->input->post('payment' . $i) == "COURSE" ? $this->input->post('payment' . $i) . ' ' . $exRegMonth[1] . '-' . $exRegMonth[0] : $this->input->post('payment' . $i),
							'status' => 'Paid',
							'unique_code' => $latestRecord['id'],
						);
						$this->mpayment->addPaymentRegDetail($paymentRegDet);
						$paymentRegHist = array(
							'amount' => $amount,
							'unique_code' => $latestRecord['id'],
							'created_by_admin' => $this->session->userdata('nama'),
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s'),
						);
						$this->mpayment->addPaymentHistory($paymentRegHist);
					}
				} else {
					$data = array(
						'paymentid' => $latestRecord['id'],
						'studentid' => $this->input->post('studentid' . $i),
						'voucherid' => $this->input->post('voucher' . $i),
						'category' => $this->input->post('payment' . $i),
						'monthpay' => $monthpay,
						'amount' => $amount,

					);

					// Tambahkan nilai 'other_detail' jika kategori adalah "OTHER"
					if ($this->input->post('payment' . $i) == "OTHER") {
						$data['other_detail'] = $other_detail;
					}
					$var = $this->mpaydetail->addPaydetail($data);
					$paymentReg = array(
						"total_price" => $amount,
						'class_type' => 'Reguler',
						'created_by' => $this->session->userdata('nama'),
						'updated_by' => $this->session->userdata('nama'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
					);
					$lastIdReg = $this->mpayment->addPaymentReg($paymentReg);
					$paymentRegDet = array(
						'id_payment_bill' => $lastIdReg['id'],
						'student_id' => $this->input->post('studentid' . $i),
						'category' => $this->input->post('payment' . $i),
						'price' => $amount,
						'payment' => $this->input->post('payment' . $i) == "COURSE" ? $this->input->post('payment' . $i) . ' ' . $exRegMonth[1] . '-' . $exRegMonth[0] : $this->input->post('payment' . $i),
						'status' => 'Paid',
						'unique_code' => $latestRecord['id'],
					);
					$this->mpayment->addPaymentRegDetail($paymentRegDet);
					$paymentRegHist = array(
						'amount' => $amount,
						'unique_code' => $latestRecord['id'],
						'created_by_admin' => $this->session->userdata('nama'),
						'created_at' => date('Y-m-d H:i:s'),
						'updated_at' => date('Y-m-d H:i:s'),
					);
					$this->mpayment->addPaymentHistory($paymentRegHist);
				}
			} else {
				$data = array(
					'paymentid' => $latestRecord['id'],
					'studentid' => $this->input->post('studentid' . $i),
					'voucherid' => $this->input->post('voucher' . $i),
					'category' => $this->input->post('payment' . $i),
					'amount' => $amount,
				);

				// Tambahkan nilai 'other_detail' jika kategori adalah "OTHER"
				if ($this->input->post('payment' . $i) == "OTHER") {
					$data['other_detail'] = $other_detail;
				}
				$var = $this->mpaydetail->addPaydetail($data);
				$paymentReg = array(
					"total_price" => $amount,
					'class_type' => 'Reguler',
					'created_by' => $this->session->userdata('nama'),
					'updated_by' => $this->session->userdata('nama'),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				);
				$lastIdReg = $this->mpayment->addPaymentReg($paymentReg);
				$paymentRegDet = array(
					'id_payment_bill' => $lastIdReg['id'],
					'student_id' => $this->input->post('studentid' . $i),
					'category' => $this->input->post('payment' . $i),
					'price' => $amount,
					'payment' => $this->input->post('payment' . $i) == "COURSE" ? $this->input->post('payment' . $i) . ' ' . $exRegMonth[1] . '-' . $exRegMonth[0] : $this->input->post('payment' . $i),
					'status' => 'Paid',
					'unique_code' => $latestRecord['id'],
				);
				$this->mpayment->addPaymentRegDetail($paymentRegDet);
				$paymentRegHist = array(
					'amount' => $amount,
					'unique_code' => $latestRecord['id'],
					'created_by_admin' => $this->session->userdata('nama'),
					'created_at' => date('Y-m-d H:i:s'),
					'updated_at' => date('Y-m-d H:i:s'),
				);
				$this->mpayment->addPaymentHistory($paymentRegHist);
			}
			$url = "https://example.com";
		}

		// ambil id akun kas dari masing-masing cabang
		$akun_kas_id = null;
		if ($this->session->userdata('branch') == '1') //jika cabang = Surabaya
			$akun_kas_id = 3;
		elseif ($this->session->userdata('branch') == '2') //jika cabang = Bali
			$akun_kas_id = 4;

		//		ambil id akun bank dari masing-masing cabang
		$akun_bank_id = null;
		if ($this->session->userdata('branch') == '1') //jika cabang = Surabaya
			$akun_bank_id = 6;
		elseif ($this->session->userdata('branch') == '2') //jika cabang = Bali
			$akun_bank_id = 7;

		//		ambil id akun pendapatan dari masing-masing cabang
		$akun_pendapatan_id = null;
		if ($this->session->userdata('branch') == '1') //jika cabang = Surabaya
			$akun_pendapatan_id = 10;
		elseif ($this->session->userdata('branch') == '2') //jika cabang = Bali
			$akun_pendapatan_id = 11;

		//		ambil id akun pendapatan denda dari masing-masing cabang
		$akun_denda_id = null;
		if ($this->session->userdata('branch') == '1') //jika cabang = Surabaya
			$akun_denda_id = 13;
		elseif ($this->session->userdata('branch') == '2') //jika cabang = Bali
			$akun_denda_id = 14;

		//jika tanpa penalty
		if ($total_penalty == null || $total_penalty == 0) {
			//		simpan transaksi jurnal
			$data_trx_akuntansi = array(
				'payment_id' => $latestRecord['id'],
				'deskripsi' => 'Income from payment id ' . $latestRecord['id'],
				'tanggal' => $date,
				'branch_id' => $this->session->userdata('branch'),
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_trx_akuntansi = $this->mtrxakuntansi->addTrxAkuntansi($data_trx_akuntansi);

			//		simpan transaksi ke detail jurnal
			$data_akun_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $this->input->post('method') == 'CASH' ? $akun_kas_id : $akun_bank_id,
				'jumlah' => $total,
				'tipe' => 'DEBIT',
				'keterangan' => 'akun',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_akun_trx_akuntansi_detail);

			$data_lawan_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $akun_pendapatan_id,
				'jumlah' => $total,
				'tipe' => 'KREDIT',
				'keterangan' => 'lawan',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_lawan_trx_akuntansi_detail);
		}
		else{ //jika ada penalty
			//		simpan transaksi jurnal
			$data_trx_akuntansi = array(
				'payment_id' => $latestRecord['id'],
				'deskripsi' => 'Income from payment id ' . $latestRecord['id'],
				'tanggal' => $date,
				'branch_id' => $this->session->userdata('branch'),
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_trx_akuntansi = $this->mtrxakuntansi->addTrxAkuntansi($data_trx_akuntansi);

			//		simpan transaksi ke detail jurnal
			$data_akun_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $this->input->post('method') == 'CASH' ? $akun_kas_id : $akun_bank_id,
				'jumlah' => $total,
				'tipe' => 'DEBIT',
				'keterangan' => 'akun',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_akun_trx_akuntansi_detail);

			//insert total tanpa penalty ke pendapatan
			$data_lawan_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $akun_pendapatan_id,
				'jumlah' => $total - $total_penalty,
				'tipe' => 'KREDIT',
				'keterangan' => 'lawan',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_lawan_trx_akuntansi_detail);

			//insert total penalty ke pendapatan denda
			$data_lawan_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $akun_denda_id,
				'jumlah' => $total_penalty,
				'tipe' => 'KREDIT',
				'keterangan' => 'lawan',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_lawan_trx_akuntansi_detail);
		}


		$this->send_notif_wa(preg_replace("/[^0-9]/", "", $this->input->post('no_hp')), $latestRecord['id'], 'Regular');
		// redirect(base_url("payment/addregular"));
		sleep(2);
		redirect(base_url("payment/addregular?print=" . $latestRecord['id']));
		//redirect(base_url("escpos/example/printregular.php?id=".$latestRecord['id']));
	}

	public function addPrivateDb()
	{

		// Hentikan eksekusi agar hasil var_dump dapat langsung dilihat
		$no_hp = $this->input->post('no_hp');
		// echo $no_hp;
		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');

		$total = $this->input->post('total');
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
			$latestRecord = $this->mpayment->addPayment($data);
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
			$latestRecord = $this->mpayment->addPayment($data);
		}

		$recordnum = $this->input->post('recordnum');
		for ($i = 1; $i <= $recordnum; $i++) {
			$amount = $this->input->post('amount' . $i);
			$order   = array("Rp ", ".");
			$replace = "";
			$amount = str_replace($order, $replace, $amount);

			$countattn = $this->input->post('attendance' . $i);
			$attendance = $this->input->post('attntxt' . $i);
			$priceattn = $this->input->post('priceattn' . $i);
			$order   = array("Rp ", ".");
			$replace = "";
			$priceattn = str_replace($order, $replace, $priceattn);
			$discount = $this->input->post('discount' . $i);

			// if ($attendance != 0) {
			// 	$explanation = '(' . $attendance . ')' . ' ' . $countattn . 'x' . $priceattn;
			// } elseif ($attendance == 0) {
			// 	$explanation = $countattn;
			// } else {
			// 	$explanation = $countattn;
			// }

			$explanation = '(' . $attendance . ')' . ' ' . $countattn . 'x' . $priceattn;


			if ($discount != null) {
				$explanation = $explanation . '-' . $discount . '%';
			}

			if ($this->input->post('voucher' . $i) != "") {
				$data = array(
					'isused' => "NO"
				);
				$where['id'] = $this->input->post('voucher' . $i);
				$this->mvoucher->updateVoucher($data, $where);
			}

			// $category_name = $this->input->post('category' . $i);
			// this is for get category hack
			// jika counttnnya berupa angka maka counttnnya adalah course
			if (is_numeric($countattn)) {
				$cauntattnnya = "COURSE";
			} else {
				$cauntattnnya = $countattn;
			}

			// if ($countattn == 1) {
			// 	$cauntattnnya = "COURSE";
			// } else {
			// 	$cauntattnnya = $countattn;
			// }

			// $other_detail = $this->input->post('other_detail');
			$other_detail = "";
			if ($countattn == "OTHER") {
				$other_detail = $this->input->post('other_detail');
			}
			$data = array(
				'paymentid' => $latestRecord['id'],
				'studentid' => $this->input->post('studentid' . $i),
				'voucherid' => $this->input->post('voucher' . $i),
				'category' => $cauntattnnya,
				'explanation' => $explanation,
				'amount' => $amount,
				'other_detail' => $other_detail
			);
			$var = $this->mpaydetail->addPaydetail($data);

			// $nexturl = "payment/updateprivate/".$latestRecord['id'];
			// redirect(base_url($nexturl));
		}

		// ambil id akun kas dari masing-masing cabang
		$akun_kas_id = null;
		if ($this->session->userdata('branch') == '1') //jika cabang = Surabaya
			$akun_kas_id = 3;
		elseif ($this->session->userdata('branch') == '2') //jika cabang = Bali
			$akun_kas_id = 4;

		//		ambil id akun bank dari masing-masing cabang
		$akun_bank_id = null;
		if ($this->session->userdata('branch') == '1') //jika cabang = Surabaya
			$akun_bank_id = 6;
		elseif ($this->session->userdata('branch') == '2') //jika cabang = Bali
			$akun_bank_id = 7;

		//		ambil id akun pendapatan dari masing-masing cabang
		$akun_pendapatan_id = null;
		if ($this->session->userdata('branch') == '1') //jika cabang = Surabaya
			$akun_pendapatan_id = 10;
		elseif ($this->session->userdata('branch') == '2') //jika cabang = Bali
			$akun_pendapatan_id = 11;

		//		simpan transaksi jurnal
		$data_trx_akuntansi = array(
			'payment_id' => $latestRecord['id'],
			'deskripsi' => 'Income from payment id ' . $latestRecord['id'],
			'tanggal' => $date,
			'branch_id' => $this->session->userdata('branch'),
			'dtm_crt' => date('Y-m-d H:i:s'),
			'dtm_upd' => date('Y-m-d H:i:s'),
		);
		$id_trx_akuntansi = $this->mtrxakuntansi->addTrxAkuntansi($data_trx_akuntansi);

		//		simpan transaksi ke detail jurnal
		$data_akun_trx_akuntansi_detail = array(
			'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
			'id_akun' => $this->input->post('method') == 'CASH' ? $akun_kas_id : $akun_bank_id,
			'jumlah' => $total,
			'tipe' => 'DEBIT',
			'keterangan' => 'akun',
			'dtm_crt' => date('Y-m-d H:i:s'),
			'dtm_upd' => date('Y-m-d H:i:s'),
		);
		$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_akun_trx_akuntansi_detail);

		$data_lawan_trx_akuntansi_detail = array(
			'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
			'id_akun' => $akun_pendapatan_id,
			'jumlah' => $total,
			'tipe' => 'KREDIT',
			'keterangan' => 'lawan',
			'dtm_crt' => date('Y-m-d H:i:s'),
			'dtm_upd' => date('Y-m-d H:i:s'),
		);
		$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_lawan_trx_akuntansi_detail);

		$this->send_notif_wa(preg_replace("/[^0-9]/", "", $this->input->post('no_hp')), $latestRecord['id'], 'Private');
		// redirect(base_url("payment/addprivate"));
		sleep(2);
		redirect(base_url("payment/addprivate?print=" . $latestRecord['id']));
		redirect(base_url("escpos/example/printprivate.php?id=" . $latestRecord['id']));
	}

	public function addOtherDb()
	{


		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');

		$total = $this->input->post('total');
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
			$latestRecord = $this->mpayment->addPayment($data);
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
			$latestRecord = $this->mpayment->addPayment($data);
		}

		$recordnum = $this->input->post('recordnum');
		for ($i = 1; $i <= $recordnum; $i++) {
			$amount = $this->input->post('amount' . $i);
			$order   = array("Rp ", ".");
			$replace = "";
			$amount = str_replace($order, $replace, $amount);

			if ($this->input->post('category') == "PENALTY") {
				$data = array(
					'paymentid' => $latestRecord['id'],
					'studentid' => $this->input->post('studentid' . $i),
					'category' => $this->input->post('payment' . $i),
					'monthpay' => $date,
					'amount' => $amount
				);
				$var = $this->mpaydetail->addPaydetail($data);
			} else {
				$data = array(
					'paymentid' => $latestRecord['id'],
					'studentid' => $this->input->post('studentid' . $i),
					'category' => $this->input->post('payment' . $i),
					'amount' => $amount
				);
				$var = $this->mpaydetail->addPaydetail($data);
			}

			// $nexturl = "payment/updateother/".$latestRecord['id'];
			// redirect(base_url($nexturl));
		}

		$this->send_notif_wa(preg_replace("/[^0-9]/", "", $this->input->post('no_hp')), $latestRecord['id'], 'Other');
		// redirect(base_url("payment/addregular"));
		sleep(2);
		redirect(base_url("payment/addother?print=" . $latestRecord['id']));

		// // redirect(base_url("payment/addother"));
		// redirect(base_url("payment/addother?print=" . $latestRecord['id']));
		// sleep(2);
		//redirect(base_url("escpos/example/printother.php?id=".$latestRecord['id']));
	}

	public function updateRegular($id)
	{
		$data['payment'] = $this->mpayment->getPaymentById($id);
		$data['listStudent'] = $this->mstudent->getAllRegular();
		$data['listPrice'] = $this->mprice->getAllPrice();
		$data['listVoucher'] = $this->mvoucher->getAllVoucherYes();
		$data['listPaydetail'] = $this->mpaydetail->getPaydetailByPaymentId($id);
		$this->load->view('v_header');
		$this->load->view('v_regularedit', $data);
		$this->load->view('v_footer');
	}

	public function updatePrivate($id)
	{
		$data['payment'] = $this->mpayment->getPaymentById($id);
		$data['listStudent'] = $this->mstudent->getAllPrivate();
		$data['listPrice'] = $this->mprice->getAllPrice();
		$data['listVoucher'] = $this->mvoucher->getAllVoucherYes();
		$data['listPaydetail'] = $this->mpaydetail->getPaydetailByPaymentId($id);
		$this->load->view('v_header');
		$this->load->view('v_privateedit', $data);
		$this->load->view('v_footer');
	}

	public function updateOther($id)
	{
		$data['payment'] = $this->mpayment->getPaymentById($id);
		$data['listStudent'] = $this->mstudent->getAllActive();
		$data['listPrice'] = $this->mprice->getAllPrice();
		$data['listPaydetail'] = $this->mpaydetail->getPaydetailByPaymentId($id);
		$this->load->view('v_header');
		$this->load->view('v_otheredit', $data);
		$this->load->view('v_footer');
	}

	public function updateRegularDb($id)
	{
		$amount = $this->input->post('amount');
		$order   = array("Rp ", ".");
		$replace = "";
		$amount = str_replace($order, $replace, $amount);

		$var = $this->input->post('monthpay');
		$parts = explode('-', $var);
		$monthpay = $parts[1] . '-' . $parts[0] . '-' . '1';

		if ($this->input->post('vid') != "") {
			$data = array(
				'isused' => "NO"
			);
			$where['id'] = $this->input->post('vid');
			$this->mvoucher->updateVoucher($data, $where);
		}

		if ($this->input->post('category') == "COURSE") {
			$data = array(
				'paymentid' => $id,
				'studentid' => $this->input->post('studentid'),
				'voucherid' => $this->input->post('vid'),
				'category' => $this->input->post('category'),
				'monthpay' => $monthpay,
				'amount' => $amount
			);
			$var = $this->mpaydetail->addPaydetail($data);
		} else {
			$data = array(
				'paymentid' => $id,
				'studentid' => $this->input->post('studentid'),
				'voucherid' => $this->input->post('vid'),
				'category' => $this->input->post('category'),
				'amount' => $amount
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}

		$nexturl = "payment/updateregular/" . $id;
		redirect(base_url($nexturl));
	}

	public function updatePrivateDb($id)
	{
		$amount = $this->input->post('amount');
		$order   = array("Rp ", ".");
		$replace = "";
		$amount = str_replace($order, $replace, $amount);

		$var = $this->input->post('monthpay');
		$parts = explode('-', $var);
		$monthpay = $parts[1] . '-' . $parts[0] . '-' . '1';

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

		if ($this->input->post('vid') != "") {
			$data = array(
				'isused' => "NO"
			);
			$where['id'] = $this->input->post('vid');
			$this->mvoucher->updateVoucher($data, $where);
		}

		$data = array(
			'paymentid' => $id,
			'studentid' => $this->input->post('studentid'),
			'voucherid' => $this->input->post('vid'),
			'category' => "COURSE",
			'explanation' => $explanation,
			'amount' => $amount
		);
		$var = $this->mpaydetail->addPaydetail($data);

		$nexturl = "payment/updateprivate/" . $id;
		redirect(base_url($nexturl));
	}

	public function updateOtherDb($id)
	{
		$date = date('Y-m-d');

		$amount = $this->input->post('amount');
		$order   = array("Rp ", ".");
		$replace = "";
		$amount = str_replace($order, $replace, $amount);

		if ($this->input->post('category') == "PENALTY") {
			$data = array(
				'paymentid' => $id,
				'studentid' => $this->input->post('studentid'),
				'category' => $this->input->post('category'),
				'monthpay' => $date,
				'amount' => $amount
			);
			$var = $this->mpaydetail->addPaydetail($data);
		} elseif ($this->input->post('category') == "OTHER") {
			$data = array(
				'paymentid' => $id,
				'studentid' => $this->input->post('studentid'),
				'category' => $this->input->post('other'),
				'amount' => $amount
			);
			$var = $this->mpaydetail->addPaydetail($data);
		} else {
			$data = array(
				'paymentid' => $id,
				'studentid' => $this->input->post('studentid'),
				'category' => $this->input->post('category'),
				'amount' => $amount
			);
			$var = $this->mpaydetail->addPaydetail($data);
		}

		$nexturl = "payment/updateother/" . $id;
		redirect(base_url($nexturl));
	}

	public function submitRegularDb($id)
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');

		$total = $this->input->post('total');
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
			$where['id'] = $id;
			$this->mpayment->updatePayment($data, $where);
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
			$where['id'] = $id;
			$this->mpayment->updatePayment($data, $where);
		}

		// redirect(base_url("payment/addregular"));

		redirect(base_url("escpos/example/printregular.php?id=" . $id));
	}

	public function submitPrivateDb($id)
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');

		$total = $this->input->post('total');
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
			$where['id'] = $id;
			$this->mpayment->updatePayment($data, $where);
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
			$where['id'] = $id;
			$this->mpayment->updatePayment($data, $where);
		}

		// redirect(base_url("payment/addprivate"));
		redirect(base_url("escpos/example/printprivate.php?id=" . $id));
	}

	public function submitOtherDb($id)
	{
		date_default_timezone_set("Asia/Jakarta");
		$date = date('Y-m-d');
		$time = date('Y-m-d h:i:s');

		$total = $this->input->post('total');
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
			$where['id'] = $id;
			$this->mpayment->updatePayment($data, $where);
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
			$where['id'] = $id;
			$this->mpayment->updatePayment($data, $where);
		}

		// redirect(base_url("payment/addother"));
		redirect(base_url("escpos/example/printother.php?id=" . $id));
	}

	public function deletePaydetailDb($paymentid, $id)
	{
		$this->mpaydetail->deletePaydetail($id);
		$nexturl = "payment/updateregular/" . $paymentid;
		redirect(base_url($nexturl));
	}

	public function deletePrvdetailDb($paymentid, $id)
	{
		$this->mpaydetail->deletePaydetail($id);
		$nexturl = "payment/updateprivate/" . $paymentid;
		redirect(base_url($nexturl));
	}

	public function deleteOtherdetailDb($paymentid, $id)
	{
		$this->mpaydetail->deletePaydetail($id);
		$nexturl = "payment/updateother/" . $paymentid;
		redirect(base_url($nexturl));
	}

	function send_notif_wa($no_hp, $trans_id, $program)
	{
		$url = "http://127.0.0.1:8000/api/e-receipt/$trans_id/$no_hp?program=$program";
		$token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvcHJpbXRlY2gtc2lzdGVtLmNvbVwvdWktcGF5bWVudC1iYWNrb2ZmaWNlXC9wdWJsaWNcL2FwaVwvYXV0aGVudGljYXRlIiwiaWF0IjoxNzIwMTc1MTczLCJleHAiOjE3NTE3MTExNzMsIm5iZiI6MTcyMDE3NTE3MywianRpIjoiQVN3RUphUVQ5SmJWRDlpMyIsInN1YiI6MTcsInBydiI6IjJhZGY2ZDVkZmI2MmI4ODc3OTQ4YTAzMmQwYzc3Y2E2MjVhZDJkNzcifQ.ld9GMtj1a59rSwZr0f2iw8IdIfqxU1F_Ot7XGaroUHo";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		$headers = [
			"Authorization: Bearer $token",
			"Content-Type: application/json"
		];
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Error: ' . curl_error($ch);
		} else {
			echo $response;
		}

		curl_close($ch);
	}
}
