<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Report extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model("mexpense");
		$this->load->model("mexpdetail");
		$this->load->model("mpayment");
		$this->load->model("mpaydetail");
		$this->load->model("mstudent");
		$this->load->model("mreport");
		$this->load->model("MTrxAkuntansi");
		$this->load->model("MTrxAkuntansiDetail");
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("user"));
		}
		$this->load->library('curl');
	}

	public function expense()
	{
		$this->load->view('v_header');
		$this->load->view('v_reportexp');
		$this->load->view('v_footer');
	}

	public function showExpense()
	{
		if ($this->input->post('startdate') == "") {
			$this->load->view('v_header');
			$this->load->view('v_reportexp');
			$this->load->view('v_footer');
		} else {
			$var = $this->input->post('startdate');
			$parts = explode('/', $var);
			$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$var = $this->input->post('enddate');
			$parts = explode('/', $var);
			$enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$data['listExpdetail'] = $this->mreport->getExpense($startdate, $enddate);
//			print_r($data['listExpdetail']);
			$this->load->view('v_header');
			$this->load->view('v_reportexp', $data);
			$this->load->view('v_footer');
		}
	}


	public function showLate()
	{

		if ($this->input->post('month') == "") {
			$this->load->view('v_header');
			$this->load->view('v_reportlate');
			$this->load->view('v_footer');
		} else {

			$month = $this->input->post('month');
			// $parts = explode('/',$var);
			// $month = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$year = $this->input->post('year');
			// $parts = explode('/',$var);
			// $enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$listLateStudent = $this->mreport->getLatePayment($month, $year);
			foreach ($listLateStudent as $key => $student) {
				$monthpay = date("m", strtotime($student->monthpay));
				// if (($monthpay < date('m')) || ($student->monthpay == '')) {
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
				// } else {
				// $data = array(
				// 'penalty' => 0
				// );
				// $where['id'] = $student->id;
				// $this->mstudent->updateStudent($data, $where);

				// unset($listLateStudent[$key]);
				// }
			}

			$data['listLateStudent'] = $listLateStudent;
			$this->load->view('v_header');
			$this->load->view('v_reportlate', $data);
			$this->load->view('v_footer');
		}
	}

	public function showGeneral()
	{
		if ($this->input->post('startdate') == "") {
			$this->load->view('v_header');
			$this->load->view('v_reportgeneral');
			$this->load->view('v_footer');
		} else {
			$var = $this->input->post('startdate');
			$parts = explode('/', $var);
			$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$var = $this->input->post('enddate');
			$parts = explode('/', $var);
			$enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$listGeneral = $this->mreport->getGeneral($startdate, $enddate);
			$studenttmp = "";
			$programtmp = "";
			$idcek = "";
			$studentcek = "";
			$counter = 0;
			$count = 0;
			foreach ($listGeneral as $key => $general) {
				$counter = $counter + 1;
			}
			foreach ($listGeneral as $key => $general) {
				$count = $count + 1;

				if ($idcek == $general->id) {
					if ($studentcek != $general->name) {
						$studenttmp = $studenttmp . " +<br>" . $general->name;
						$programtmp = $programtmp . " +<br>" . $general->program;
						if ($count - 2 >= 0) {
							$listGeneral[$count - 2]->status = "unset";
						}
					} else {
						$general->status = "unset";
					}

					if ($count != $counter) {
						if ($general->id != $listGeneral[$count]->id) {
							$general->name = $studenttmp;
							$general->program = $programtmp;
							$general->status = "ACTIVE";
						} else {
							$general->status = "unset";
						}
					} elseif ($count == $counter) {
						$general->name = $studenttmp;
						$general->program = $programtmp;
					}
				} else {
					$studenttmp = $general->name;
					$programtmp = $general->program;
					$general->status = "unset";
					if ($count != $counter) {
						if ($general->id != $listGeneral[$count]->id) {
							$general->status = "ACTIVE";
						}
					} elseif ($count == $counter) {
						$general->status = "ACTIVE";
					}
				}
				$studentcek = $general->name;
				$idcek = $general->id;
			}

			foreach ($listGeneral as $key => $general) {
				if ($general->status == "unset") {
					unset($listGeneral[$key]);
				}
			}

			// foreach ($listGeneral as $key => $general) {
			// 	echo $general->id . " || " . $general->paydate . " || " . $general->name . " || " . $general->program . " || " .
			// 	$general->method . " || " . $general->status . "<br>";
			// }

			$data['listGeneral'] = $listGeneral;
			$this->load->view('v_header');
			$this->load->view('v_reportgeneral', $data);
			$this->load->view('v_footer');
		}
	}

	public function showDetail()
	{
		if ($this->input->post('startdate') == "") {
			$this->load->view('v_header');
			$this->load->view('v_reportdetail');
			$this->load->view('v_footer');
		} else {
			$var = $this->input->post('startdate');
			$parts = explode('/', $var);
			$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$var = $this->input->post('enddate');
			$parts = explode('/', $var);
			$enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$listDetail = $this->mreport->getDetail($startdate, $enddate);
			$studenttmp = "";
			$programtmp = "";
			$registrationtmp = 0;
			$booktmp = 0;
			$agendatmp = 0;
			$coursetmp = 0;
			$idcek = "";
			$studentcek = "";
			$counter = 0;
			$count = 0;
			foreach ($listDetail as $key => $detail) {
				$detail->registration = 0;
				$detail->book = 0;
				$detail->agenda = 0;
				$detail->course = 0;
				$counter = $counter + 1;
			}
			foreach ($listDetail as $key => $detail) {
				$count = $count + 1;

				if ($idcek == $detail->id) {
					if ($studentcek != $detail->name) {
						if (($detail->program == "Private" || $detail->program == "Semi Private") && $detail->explanation != "") {
							$studenttmp = $studenttmp . " +<br>" . $detail->name . " " . $detail->explanation;
							$programtmp = $programtmp . " +<br>" . $detail->program;
						} else {
							$studenttmp = $studenttmp . " +<br>" . $detail->name;
							$programtmp = $programtmp . " +<br>" . $detail->program;
						}
						if ($count - 2 >= 0) {
							$listDetail[$count - 2]->status = "unset";
						}
					} else {
						if (($detail->program == "Private" || $detail->program == "Semi Private") && $detail->explanation != "") {
							$studenttmp = $studenttmp . " " . $detail->explanation;
						}
						$detail->status = "unset";
					}

					if ($detail->category == "REGISTRATION") {
						$registrationtmp = $registrationtmp + $detail->amount;
					} elseif ($detail->category == "BOOK" || $detail->category == "POINT BOOK") {
						$booktmp = $booktmp + $detail->amount;
					} elseif ($detail->category == "AGENDA") {
						$agendatmp = $agendatmp + $detail->amount;
					} elseif ($detail->category == "COURSE") {
						$coursetmp = $coursetmp + $detail->amount;
					}

					if ($count != $counter) {
						if ($detail->id != $listDetail[$count]->id) {
							$detail->name = $studenttmp;
							$detail->program = $programtmp;
							$detail->registration = $registrationtmp;
							$detail->book = $booktmp;
							$detail->agenda = $agendatmp;
							$detail->course = $coursetmp;
							$detail->status = "ACTIVE";
						} else {
							$detail->status = "unset";
						}
					} elseif ($count == $counter) {
						$detail->name = $studenttmp;
						$detail->program = $programtmp;
						$detail->registration = $registrationtmp;
						$detail->book = $booktmp;
						$detail->agenda = $agendatmp;
						$detail->course = $coursetmp;
					}
				} else {
					if ($detail->program == "Private" || $detail->program == "Semi Private") {
						$studenttmp = $detail->name . " " . $detail->explanation;
						$programtmp = $detail->program;
					} else {
						$studenttmp = $detail->name;
						$programtmp = $detail->program;
					}

					$registrationtmp = 0;
					$booktmp = 0;
					$agendatmp = 0;
					$coursetmp = 0;

					if ($detail->category == "REGISTRATION") {
						$registrationtmp = $detail->amount;
					} elseif ($detail->category == "BOOK" || $detail->category == "POINT BOOK") {
						$booktmp = $detail->amount;
					} elseif ($detail->category == "AGENDA") {
						$agendatmp = $detail->amount;
					} elseif ($detail->category == "COURSE") {
						$coursetmp = $detail->amount;
					}

					$detail->status = "unset";
					if ($count != $counter) {
						if ($detail->id != $listDetail[$count]->id) {
							$detail->status = "ACTIVE";
						}
					} elseif ($count == $counter) {
						$detail->status = "ACTIVE";
					}
				}
				$studentcek = $detail->name;
				$idcek = $detail->id;
			}

			foreach ($listDetail as $key => $detail) {
				if ($detail->status == "unset") {
					unset($listDetail[$key]);
				}
			}

			// foreach ($listDetail as $key => $detail) {
			// 	echo $detail->id . " || " . $detail->paydate . " || " . $detail->name . " || " . $detail->program . " || " .
			// 	$detail->method . " || " . $detail->status . " || " . $detail->registration . " || " . $detail->book . " || " .
			// 	$detail->agenda . " || " . $detail->course . " || " . $detail->explanation . "<br>";
			// }

			$data['listDetail'] = $listDetail;
			$this->load->view('v_header');
			$this->load->view('v_reportdetail', $data);
			$this->load->view('v_footer');
		}
	}

	public function showTrans()
	{
		if ($this->input->post('startdate') == "") {
			$data['from'] = '';
			$data['to'] = '';
			$this->load->view('v_header');
			$this->load->view('v_reporttrans', $data);
			$this->load->view('v_footer');
		} else {
			$poststartdate = $this->input->post('startdate');
			$parts = explode('/', $poststartdate);
			$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$postenddate = $this->input->post('enddate');
			$parts = explode('/', $postenddate);
			$enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];


			$data['listTransaction'] = $this->mreport->getTransaction($startdate, $enddate);
			$data['listDetailPayment'] = $this->mreport->getDetailPayment($startdate, $enddate);
			$data['from'] = $startdate;
			$data['to'] = $enddate;
			$this->load->view('v_header');
			$this->load->view('v_reporttrans', $data);
			$this->load->view('v_footer');
		}
	}


	public function printTrans($id, $program)
	{
		if (strpos($program, 'Private') !== false) {
			//redirect(base_url("escpos/example/reprintprivate.php?id=".$id));
			redirect(base_url("cetak/printprivate/" . $id));
		} else {
			//redirect(base_url("escpos/example/reprintregular.php?id=".$id));
			redirect(base_url("cetak/printregular/" . $id));
		}
	}


	public function deleteExpdetailDb($expenseid, $id)
	{
		$this->mexpdetail->deleteExpdetail($id);
		$nexturl = "report/showexpense";
		redirect(base_url($nexturl));
	}

	public function deletePaymentDb($paymentid)
	{

		// First get the accounting transaction IDs before deleting
		$accounting_trx = $this->db->get_where('tbl_trx_akuntansi', ['payment_id' => $paymentid])->result();

		// Store the IDs to delete details later
		$trx_ids = array_map(function($trx) {
			return $trx->id_trx_akun;
		}, $accounting_trx);

		// Delete from accounting detail table first (foreign key consideration)
		if (!empty($trx_ids)) {
			$this->db->where_in('id_trx_akun', $trx_ids);
			$this->db->delete('tbl_trx_akuntansi_detail');
		}

		// Delete from main accounting table
		$this->db->where('payment_id', $paymentid);
		$this->db->delete('tbl_trx_akuntansi');

		$data = array(
			'method' => "CANCEL",
			'number' => "",
			'bank' => "",
			'trfdate' => "0000-00-00",
			'total' => 0
		);
		$where['id'] = $paymentid;
		$this->mpayment->updatePayment($data, $where);

		$listPayDetail = $this->mpaydetail->getPaydetailByPaymentId($paymentid);
		foreach ($listPayDetail->result() as $payDetail) {
			$data = array(
				'voucherid' => "",
				'category' => "CANCEL",
				'monthpay' => "0000-00-00",
				'amount' => 0
			);
			$where['id'] = $payDetail->id;
			$this->mpaydetail->updatePaydetail($data, $where);
		}
		// $this->mpaydetail->deletePaydetailByPaymentId($paymentid);
		// $this->mpayment->deletePayment($paymentid);
		$nexturl = "report/showtrans";
		redirect(base_url($nexturl));
	}

	public function exportExcel()
	{
		// fungsi header dengan mengirimkan raw data excel
		header("Content-type: application/vnd-ms-excel");

		// membuat nama file ekspor "export-to-excel.xls"
		header("Content-Disposition: attachment; filename=UI Payment System.xls");

		// tambahkan table
		$from = $_GET['from']; //2022-11-01
		$to = $_GET['to']; //2022-11-02
		$data['listTransaction'] = $this->mreport->getAllPayment($from, $to);

		// echo '<pre>';
		// var_dump($data);
		// die;
		$this->load->view('v_exportexcel', $data);
	}


	public function eReceipt($transactionId, $program)
	{

		$phoneNumber = $this->input->get('phone_number');

		if (!empty($program)) {
			if ($program == 'Private') {
				$program = 'Private';
			} else {
				$program = 'Regular';
			}
		}

		// Periksa apakah nomor telepon ada
		if (empty($phoneNumber)) {
			// Set flashdata untuk alert gagal
			$this->session->set_flashdata('alert', 'Phone number is required.');
			// Redirect ke halaman sebelumnya
			redirect($this->agent->referrer());
			return;
		}


		// Cek apakah ID disediakan
		if (empty($transactionId)) {
			// Return error response jika ID tidak disediakan
			$response = [
				'status' => false,
				'message' => 'Payment ID is required.'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			return;
		}

		// $base_url = base_url();
		// Base URL untuk API
		$baseUrl = "https://ui-backoffice.primtechdev.com/api/";
		$url = $baseUrl . "e-receipt/" . $transactionId . '/' . $phoneNumber . '?program=' . $program;

		// Inisialisasi CURL dengan CodeIgniter
		$this->load->library('curl');

		// Set CURL options
		$headers = [
			'Content-Type: application/json',
			'Authorization: Bearer ' .
				'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvcHJpbXRlY2gtc2lzdGVtLmNvbVwvdWktcGF5bWVudC1iYWNrb2ZmaWNlXC9wdWJsaWNcL2FwaVwvYXV0aGVudGljYXRlIiwiaWF0IjoxNzIwMTc1MTczLCJleHAiOjE3NTE3MTExNzMsIm5iZiI6MTcyMDE3NTE3MywianRpIjoiQVN3RUphUVQ5SmJWRDlpMyIsInN1YiI6MTcsInBydiI6IjJhZGY2ZDVkZmI2MmI4ODc3OTQ4YTAzMmQwYzc3Y2E2MjVhZDJkNzcifQ.ld9GMtj1a59rSwZr0f2iw8IdIfqxU1F_Ot7XGaroUHo'
		];
		$this->curl->create($url);
		$this->curl->http_header($headers);
		$this->curl->option(CURLOPT_RETURNTRANSFER, true);

		// Eksekusi CURL dan dapatkan hasilnya
		$result = $this->curl->execute();

		// Cek apakah terjadi kesalahan pada CURL
		if ($this->curl->error_code) {
			$response = [
				'status' => false,
				'message' => 'CURL Error: ' . $this->curl->error_string
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
			return;
		}

		// Decode respon JSON
		$decodedResult = json_decode($result, true);

		// Kirim kembali respon
		if (is_array($decodedResult)) {
			// Set flashdata untuk alert sukses
			$this->session->set_flashdata('alert', 'Success resend e-receipt.');

			// Redirect ke halaman lain setelah menyimpan pesan dalam sesi
			redirect(base_url('report/showTrans'));
		} else {
			// Handle kesalahan saat decode JSON
			$response = [
				'status' => false,
				'message' => 'Failed to decode the API response.'
			];
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode($response));
		}
	}
}
