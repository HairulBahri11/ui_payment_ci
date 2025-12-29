<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("mdashboard"); 
		$this->load->model("mpayment"); 
		$this->load->model("mstudent"); 
		$this->load->model("mprice"); 
		$this->load->model("mvoucher"); 
		$this->load->model("mpaydetail");   
		$this->load->model("mexpense"); 
		$this->load->model("mexpdetail");  
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{	
	
		$totalPay = $this->mdashboard->getTotalPayment();
		$data['totalPay'] = $totalPay['totalpay'];
		$totalExp = $this->mdashboard->getTotalExpense();
		$data['totalExp'] = $totalExp['totalexp'];
		$activeStudent = $this->mdashboard->getActiveStudent();
		$data['activeStudent'] = $activeStudent['studentnum'];

		$listLateStudent = $this->mdashboard->getLatePayment(date('Y'), date('m'));
		$countLate = $listLateStudent['jmlLatePayment'];
		$countTime = 0;
		// foreach ($listLateStudent as $student) {
			// $monthpay = date("m",strtotime($student->monthpay));
			// if (($monthpay < date('m')) || ($student->monthpay == '')) {
				// $countLate = $countLate + 1;
			// }
		// }
		$data['listLateStudent'] = $countLate;
		$countTime = $activeStudent['studentnum'] - $countLate;
		$data['listTimeStudent'] = $countTime;

		$data['listMonthlyPay'] = $this->mdashboard->getMonthlyPayment();
		$data['listMonthlyExp'] = $this->mdashboard->getMonthlyExpense(); 

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

		$listUncomplete = $this->mexpense->getUncompleteExpense();
		foreach ($listUncomplete as $uncomplete) {
			$this->mexpense->deleteExpense($uncomplete->id);
			$this->mexpdetail->deleteExpdetailByExpenseId($uncomplete->id);
		}

		$this->load->view('v_header');
		$this->load->view('v_dashboard', $data); 
		$this->load->view('v_footer');
	}

}
?>