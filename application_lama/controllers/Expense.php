<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expense extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("mexpense"); 
		$this->load->model("mexpdetail");   
		if($this->session->userdata('status') != "login"){
			redirect(base_url("user"));
		}
	}

	public function index()
	{
		
	}

	public function addExpense()
	{
		$listUncomplete = $this->mexpense->getUncompleteExpense();
		foreach ($listUncomplete as $uncomplete) {
			$this->mexpense->deleteExpense($uncomplete->id);
			$this->mexpdetail->deleteExpdetailByExpenseId($uncomplete->id);
		}

		$this->load->view('v_header');
		$this->load->view('v_expenseadd');
		$this->load->view('v_footer');
	}

	public function addExpenseDb()
	{
		$date = date('Y-m-d');
		$data = array(
				'entrydate' => $date
				);
		$latestRecord = $this->mexpense->addExpense($data);

		$amount = $this->input->post('amount');
		$order   = array("Rp ", ".");
		$replace = "";
		$amount = str_replace($order, $replace, $amount);

		$var = $this->input->post('expdate');
		$parts = explode('/',$var);
		$expdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

		if ($this->input->post('category') == "OTHER") {
			$data = array(
					'expenseid' => $latestRecord['id'],
					'category' => $this->input->post('other'),
					'explanation' => $this->input->post('explanation'),
					'expdate' => $expdate,
					'amount' => $amount
					);
			$var = $this->mexpdetail->addExpdetail($data);
		} else {
			$data = array(
					'expenseid' => $latestRecord['id'],
					'category' => $this->input->post('category'),
					'explanation' => $this->input->post('explanation'),
					'expdate' => $expdate,
					'amount' => $amount
					);
			$var = $this->mexpdetail->addExpdetail($data);
		}

		$nexturl = "expense/updateexpense/".$latestRecord['id'];
		redirect(base_url($nexturl));
	}

	public function updateExpense($id)
	{
		$data['expense'] = $this->mexpense->getExpenseById($id); 
		$data['listExpdetail'] = $this->mexpdetail->getExpdetailByExpenseId($id);
		$this->load->view('v_header');
		$this->load->view('v_expenseedit', $data);
		$this->load->view('v_footer');
	}

	public function updateExpenseDb($id)
	{
		$amount = $this->input->post('amount');
		$order   = array("Rp ", ".");
		$replace = "";
		$amount = str_replace($order, $replace, $amount);

		$var = $this->input->post('expdate');
		$parts = explode('/',$var);
		$expdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];

		if ($this->input->post('category') == "OTHER") {
			$data = array(
					'expenseid' => $id,
					'category' => $this->input->post('other'),
					'explanation' => $this->input->post('explanation'),
					'expdate' => $expdate,
					'amount' => $amount
					);
			$var = $this->mexpdetail->addExpdetail($data);
		} else {
			$data = array(
					'expenseid' => $id,
					'category' => $this->input->post('category'),
					'explanation' => $this->input->post('explanation'),
					'expdate' => $expdate,
					'amount' => $amount
					);
			$var = $this->mexpdetail->addExpdetail($data);
		}

		$nexturl = "expense/updateexpense/".$id;
		redirect(base_url($nexturl));
	}
	
	public function submitExpenseDb($id)
	{
		$date = date('Y-m-d');
		
		$total = $this->input->post('total');
		$order   = array("Rp ", ".");
		$replace = "";
		$total = str_replace($order, $replace, $total);
		
		$data = array(
				'entrydate' => $date,
				'total' => $total
				);
				
		$where['id'] = $id;
		$this->mexpense->updateExpense($data, $where);

		redirect(base_url("expense/addexpense"));
	}

	public function deleteExpdetailDb($expenseid, $id)
	{
		$this->mexpdetail->deleteExpdetail($id); 
		$nexturl = "expense/updateexpense/".$expenseid;
		redirect(base_url($nexturl));
	}

	
}
?>