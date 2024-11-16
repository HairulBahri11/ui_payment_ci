<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Voucher extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("mvoucher"); 
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$data['listVoucher'] = $this->mvoucher->getAllVoucher(); 
		$this->load->view('v_header');
		$this->load->view('v_voucherlist', $data); 
		$this->load->view('v_footer');
	}

	public function addVoucher()
	{
		$this->load->view('v_header');
		$this->load->view('v_voucheradd');
		$this->load->view('v_footer');
	}

	public function addVoucherDb()
	{
		$amount = $this->input->post('amount');

		$order   = array("Rp ", ".");
		$replace = "";

		$amount = str_replace($order, $replace, $amount);

		$data = array(
				'id' => $this->input->post('code'),
				'type' => $this->input->post('type'),
				'amount' => $amount,
				'isused' => "YES"
				);
		$latestRecord = $this->mvoucher->addVoucher($data);

		redirect(base_url("voucher"));
	}

	public function updateVoucher($id)
	{
		$data['voucher'] = $this->mvoucher->getVoucherById($id); 
		
		$this->load->view('v_header');
		$this->load->view('v_voucheredit', $data);
		$this->load->view('v_footer');
	}

	public function updateVoucherDb()
	{
		$amount = $this->input->post('amount');

		$order   = array("Rp ", ".");
		$replace = "";

		$amount = str_replace($order, $replace, $amount);

		$data = array(
				'type' => $this->input->post('type'),
				'amount' => $amount
				);
				
		$where['id'] = $this->input->post('id');
		$this->mvoucher->updateVoucher($data, $where); 

		redirect(base_url("voucher"));
	}

	public function deleteVoucherDb($id)
	{
		$this->mvoucher->deleteVoucher($id); 
		redirect(base_url("voucher"));
	}
}
?>