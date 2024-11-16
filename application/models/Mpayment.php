<?php
//File products_model.php
class Mpayment extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAllPayment()
	{
		//select semua data yang ada pada table msProduct $this--->db->select("*");
		$this->db->select("*");
		$this->db->from("payment");
		return $this->db->get();
	}

	function getPaymentById($id)
	{
		$this->db->select("*");
		$this->db->from("payment");
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function addPayment($data)
	{
		$this->db->insert('payment', $data);
		$id = $this->db->insert_id();
		$query = $this->db->query("SELECT id FROM payment where id=$id");
		// $query = $this->db->query("SELECT id FROM payment ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function updatePayment($data, $where)
	{
		$this->db->where($where);
		$this->db->update('payment', $data);
	}

	function deletePayment($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('payment');
	}

	function getUncompletePayment()
	{
		$query = $this->db->query("SELECT *
								   FROM payment
								   WHERE method = ''");
		$result = $query->result();
		return $result;
	}

	function getUncompleteVoucher($id)
	{
		$query = $this->db->query("SELECT *
								   FROM paydetail
								   WHERE paymentid = '" . $id . "'");
		$result = $query->result();
		return $result;
	}

	function getPaymentReg($id, $year, $month)
	{
		$query = $this->db->query("SELECT *
								   FROM payment_bill_detail
								   WHERE category = 'COURSE'
								   AND student_id = '" . $id . "' AND payment = 'COURSE " . $month . '-' . $year . "'");
		$result = $query->result();
		return $result;
	}

	function updatePaymentReg($data, $where, $where1, $where2)
	{
		$this->db->where('student_id', $where);
		$this->db->where('category', $where1);
		$this->db->where('payment', $where2);
		$this->db->update('payment_bill_detail', $data);
		// $this->db->affected_rows();
	}

	function test($data, $where, $where1, $where2)
	{
		$query = $this->db->query("SELECT id FROM payment_bill_detail where student_id='$where' AND category='$where1' and payment='$where2'");
		$result = $query->result();
		return $result;
		// $this->db->affected_rows();
	}

	function addPaymentReg($data)
	{
		$this->db->insert('payment_bills', $data);
		$id = $this->db->insert_id();
		$query = $this->db->query("SELECT id FROM payment_bills where id=$id");
		$result = $query->row_array();
		return $result;
	}

	function addPaymentRegDetail($data)
	{
		$this->db->insert('payment_bill_detail', $data);
		// $id = $this->db->insert_id();
		// $query = $this->db->query("SELECT id FROM payment_bills where id=$id");
		// $result = $query->row_array();
		// return $result;
	}

	function addPaymentHistory($data)
	{
		$this->db->insert('history_billing', $data);
		// $id = $this->db->insert_id();
		// $query = $this->db->query("SELECT id FROM payment_bills where id=$id");
		// $result = $query->row_array();
		// return $result;
	}


	function updateHistyoryReg($data, $where)
	{
		$this->db->where('unique_code', $where);
		$this->db->update('history_billing', $data);
		// $this->db->affected_rows();
	}
}
