<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("mexpense"); 
		$this->load->model("mexpdetail");   
		$this->load->model("mpayment"); 
		$this->load->model("mpaydetail");   
		$this->load->model("mstudent");  
		$this->load->model("mreport");   
		if($this->session->userdata('status') != "login"){
			redirect(base_url("user"));
		}
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
			$parts = explode('/',$var);
			$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$var = $this->input->post('enddate');
			$parts = explode('/',$var);
			$enddate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$data['listExpdetail'] = $this->mreport->getExpense($startdate, $enddate);
			$this->load->view('v_header');
			$this->load->view('v_reportexp', $data);
			$this->load->view('v_footer');
		}
	}


	public function showLate()
	{
		$listLateStudent = $this->mreport->getLatePayment();
		foreach ($listLateStudent as $key => $student) {
			$monthpay = date("m",strtotime($student->monthpay));
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

				unset($listLateStudent[$key]);
			}
		}

		$data['listLateStudent'] = $listLateStudent;
		$this->load->view('v_header');
		$this->load->view('v_reportlate', $data);
		$this->load->view('v_footer');
	}

	public function showGeneral()
	{
		if ($this->input->post('startdate') == "") {
			$this->load->view('v_header');
			$this->load->view('v_reportgeneral');
			$this->load->view('v_footer');
		} else {
			$var = $this->input->post('startdate');
			$parts = explode('/',$var);
			$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$var = $this->input->post('enddate');
			$parts = explode('/',$var);
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
			$parts = explode('/',$var);
			$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

			$var = $this->input->post('enddate');
			$parts = explode('/',$var);
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
		$data['listTransaction'] = $this->mreport->getTransaction();
		$data['listDetailPayment'] = $this->mreport->getDetailPayment(); 
		$this->load->view('v_header');
		$this->load->view('v_reporttrans', $data);
		$this->load->view('v_footer');
	}


	public function printTrans($id, $program)
	{
		if (strpos($program, "Private") !== false) {
			redirect(base_url("escpos/example/reprintprivate.php?id=".$id));
		} else {
			redirect(base_url("escpos/example/reprintregular.php?id=".$id));
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
		$data = array(
				'method' => "CANCEL",
				'number' => "",
				'bank' => "",
				'trfdate' => "",
				'total' => 0
		);
		$where['id'] = $paymentid;
		$this->mpayment->updatePayment($data, $where);

		$listPayDetail = $this->mpaydetail->getPaydetailByPaymentId($paymentid);
		foreach ($listPayDetail->result() as $payDetail) {
			$data = array(
					'voucherid' => "",
					'category' => "CANCEL",
					'monthpay' => "",
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

	
}
?>