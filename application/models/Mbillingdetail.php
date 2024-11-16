<?php
class Mbillingdetail extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAllPayment()
	{
		//select semua data yang ada pada table msProduct $this--->db->select("*");
		$this->db->select("*");
		$this->db->from("payment_bill_detail");
		return $this->db->get();
	}

	function addBillDetail($data)
	{
		$this->db->insert('payment_bill_detail', $data);
		$id = $this->db->insert_id();
		$query = $this->db->query("SELECT id FROM payment_bill_detail where id=$id");
		// $query = $this->db->query("SELECT id FROM payment ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function historyStatus($kode)
	{
		$query = $this->db->query("SELECT payment_bill_detail.*, student.name as student_name FROM payment_bill_detail JOIN student ON payment_bill_detail.student_id=student.id WHERE unique_code='$kode'");
		$result = $query->row();
		return $result;
	}

	function historyDetail($column, $kode)
	{
		$query = $this->db->query(
			"SELECT payment_bill_detail.*, student.name FROM payment_bill_detail JOIN student ON payment_bill_detail.student_id=student.id
					 WHERE payment_bill_detail.$column='$kode'"
		);
		$result = $query->result();
		return $result;
	}

	function dataDetail($column, $kode)
	{
		$query = $this->db->query(
			"SELECT payment_bill_detail.*, student.name, payment_bills.class_type,payment_bills.created_at,payment_bills.updated_at FROM payment_bill_detail 
					JOIN payment_bills ON payment_bills.id=payment_bill_detail.id_payment_bill
					JOIN student ON payment_bill_detail.student_id=student.id
					WHERE payment_bill_detail.$column='$kode'"
		);
		$result = $query->result();
		return $result;
	}

	function confirm($data, $where)
	{
		$this->db->where($where);
		$this->db->update('payment_bill_detail', $data);
	}
}
