<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Expense extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("mexpense"); 
		$this->load->model("mexpdetail");   
		$this->load->model("makun");
		$this->load->model("mtrxakuntansi");
		$this->load->model("mtrxakuntansidetail");
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

		$id_akun = [];
		if ($this->session->userdata('branch') == 1) //jika surabaya
			$id_akun = [3, 6];
		elseif ($this->session->userdata('branch') == 2) // jika bali
			$id_akun = [4, 7];

		$data['id_akun'] = $this->makun->getSomeAkun($id_akun);

		$this->load->view('v_header');
		$this->load->view('v_expenseadd', $data);
		$this->load->view('v_footer');
	}

	public function addExpenseDb()
	{
		$date = date('Y-m-d');
		$data = array(
				'entrydate' => $date,
				'branch_id' => $this->session->userdata('branch')
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
					'id_akun' => $this->input->post('id_akun'),
					'category' => $this->input->post('other'),
					'explanation' => $this->input->post('explanation'),
					'expdate' => $expdate,
					'amount' => $amount
					);
			$var = $this->mexpdetail->addExpdetail($data);
		} else {
			$data = array(
					'expenseid' => $latestRecord['id'],
					'id_akun' => $this->input->post('id_akun'),
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

		$id_akun = [];
		if ($this->session->userdata('branch') == 1) //jika surabaya
			$id_akun = [3, 6];
		elseif ($this->session->userdata('branch') == 2) // jika bali
			$id_akun = [4, 7];

		$data['id_akun'] = $this->makun->getSomeAkun($id_akun);

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
					'id_akun' => $this->input->post('id_akun'),
					'category' => $this->input->post('other'),
					'explanation' => $this->input->post('explanation'),
					'expdate' => $expdate,
					'amount' => $amount
					);
			$var = $this->mexpdetail->addExpdetail($data);
		} else {
			$data = array(
					'expenseid' => $id,
					'id_akun' => $this->input->post('id_akun'),
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

//		insert into tbl_trx_akuntansi and tbl_trx_akuntansi_detail
		$id_beban = $this->session->userdata('branch') == 1 ? 17 : 18;
		$trx_akun = array(
			'expense_id' => $id,
			'deskripsi' => 'Expense from id ' . $id,
			'tanggal' => $date,
			'branch_id' => $this->session->userdata('branch'),
			'dtm_crt' => date('Y-m-d H:i:s'),
			'dtm_upd' => date('Y-m-d H:i:s'),
		);
		$id_trx_akuntansi = $this->mtrxakuntansi->addTrxAkuntansi($trx_akun);

		$expense_details = $this->mexpdetail->getExpdetailByExpenseId($id)->result();

		foreach ($expense_details as $expense_detail) {
			//		simpan transaksi ke detail jurnal
			$data_akun_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $expense_detail->id_akun,
				'jumlah' => $expense_detail->amount,
				'tipe' => 'KREDIT',
				'keterangan' => 'akun',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_akun_trx_akuntansi_detail);

			$data_lawan_trx_akuntansi_detail = array(
				'id_trx_akun' => $id_trx_akuntansi['id_trx_akun'],
				'id_akun' => $id_beban,
				'jumlah' => $expense_detail->amount,
				'tipe' => 'DEBIT',
				'keterangan' => 'lawan',
				'dtm_crt' => date('Y-m-d H:i:s'),
				'dtm_upd' => date('Y-m-d H:i:s'),
			);
			$id_akun_trx_akuntansi_detail = $this->mtrxakuntansidetail->addTrxAkuntansiDetail($data_lawan_trx_akuntansi_detail);
		}

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
