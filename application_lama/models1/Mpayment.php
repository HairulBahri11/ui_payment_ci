<?php
	//File products_model.php
	class Mpayment extends CI_Model  {
		function __construct() { parent::__construct(); } function getAllPayment() {
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

		$query = $this->db->query("SELECT id FROM payment ORDER BY id DESC LIMIT 1");
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
}

?>