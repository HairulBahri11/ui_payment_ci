<?php
class Mbilling extends CI_Model
{

	function __construct()
	{
		parent::__construct();
	}
	function getAllPayment()
	{
		//select semua data yang ada pada table msProduct $this--->db->select("*");
		$this->db->select("*");
		$this->db->from("payment_bills");
		$this->db->order_by("id", "desc");
		return $this->db->get();
	}

	function getStudentByPriceId($id)
	{
		$query = $this->db->query("SELECT s.id, s.name, s.condition, s.adjusment, lpr.program, lpr.course, lpr.monthpay
									FROM `last_payment_regular` lpr
									LEFT OUTER JOIN student s ON lpr.id_student=s.id
									WHERE s.status = 'ACTIVE'
									AND lpr.level <> 'Private'
								   AND s.priceid = " . $id . "
								   ");
		$result = $query->result();
		return $result;
	}

	public function getLastPayment($id)
	{
		$this->db->select("s.id as sid, s.priceid, s.name, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level, MAX(pd.monthpay) as monthpay");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "left outer");
		$this->db->join("paydetail pd", "s.id = pd.studentid", "left outer");
		$this->db->where('p.level !=', 'Private');
		$this->db->where('s.status =', 'ACTIVE');
		$this->db->where('s.priceid =', $id);
		$this->db->group_by('s.id');
		$this->db->order_by('s.id', 'asc');
		return $this->db->get();
	}

	function addBill($data)
	{
		$this->db->insert('payment_bills', $data);
		$id = $this->db->insert_id();
		$query = $this->db->query("SELECT id FROM payment_bills where id=$id");
		// $query = $this->db->query("SELECT id FROM payment ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function history()
	{
		$query = $this->db->query("SELECT history_billing.*, parents.name FROM history_billing LEFT JOIN parents ON history_billing.created_by=parents.id");
		$result = $query->result();
		return $result;
	}

	function penalty()
	{
		$query = $this->db->query("SELECT payment_bill_detail.*, student.name FROM payment_bill_detail LEFT JOIN student ON payment_bill_detail.student_id=student.id WHERE is_penalty = 'true' AND is_penalty_payment = 'true'");
		$result = $query->result();
		return $result;
	}

	function removePenalty($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('payment_bill_detail', $data);
	}
}
