<?php
	//File products_model.php
	class Mpaydetail extends CI_Model  {
		function __construct() { parent::__construct(); } function getAllPaydetail($id) {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
        $this->db->select("*");
		$this->db->from("paydetail");
		return $this->db->get();
	}

	function getPaydetailById($id)
	{
		$this->db->select("*");
		$this->db->from("paydetail");
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function getPaydetailByPaymentId($id)
	{
		$this->db->select("pd.id, pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, s.name, p.program, pd.explanation");
		$this->db->from("paydetail pd");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('pd.paymentid', $id);
		$this->db->order_by('id', 'asc');
		return $this->db->get();
	}

	function addPaydetail($data)
	{
		$this->db->insert('paydetail', $data);
		$id = $this->db->insert_id();
		$query = $this->db->query("SELECT id FROM paydetail where id=$id");
		$result = $query->row_array();
		return $result;
	}

	function updatePaydetail($data, $where)
	{
		$this->db->where($where);
        $this->db->update('paydetail', $data);
	}

	function deletePaydetail($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('paydetail');
	}

	function deletePaydetailByPaymentId($id)
	{
		$this->db->where('paymentid', $id);
        $this->db->delete('paydetail');
	}
}

?>
