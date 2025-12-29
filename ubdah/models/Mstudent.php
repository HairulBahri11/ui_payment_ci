<?php
	//File products_model.php
	class Mstudent extends CI_Model  {
		function __construct() { parent::__construct(); } function getAllStudent() {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
        $this->db->select("s.id as sid, s.priceid, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->order_by('sid', 'asc');
		return $this->db->get();
	}

	function getAllActive()
	{
		$this->db->select("s.id as sid, s.priceid, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('s.status =', 'ACTIVE');
		$this->db->order_by('sid', 'asc');
		return $this->db->get();
	}

	function getAllRegular()
	{
		$this->db->select("s.id as sid, s.priceid, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level, MAX(pd.monthpay) as monthpay");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "left outer");
		$this->db->join("paydetail pd", "s.id = pd.studentid", "left outer");
		$this->db->where('p.level !=', 'Private');
		$this->db->where('s.status =', 'ACTIVE');
		$this->db->group_by('s.id');
		$this->db->order_by('s.id', 'asc');
		return $this->db->get();
	}

	function getAllPrivate()
	{
		$this->db->select("s.id as sid, s.priceid, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('p.level =', 'Private');
		$this->db->where('s.status =', 'ACTIVE');
		$this->db->order_by('s.id', 'asc');
		return $this->db->get();
	}

	function getStudentById($id)
	{
		$this->db->select("s.id as sid, s.priceid, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('s.id', $id);
		return $this->db->get();
	}

	function getLatePaymentStudent()
	{
		$query = $this->db->query("SELECT s.id, s.name, s.condition, s.adjusment, p.program, p.course, py.method, MAX(pd.monthpay) as monthpay
								   FROM student s
								   LEFT OUTER JOIN price p ON s.priceid = p.id
								   LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
								   LEFT OUTER JOIN payment py ON pd.paymentid = py.id
								   WHERE s.status = 'ACTIVE'
								   AND p.level <> 'Private'
								   GROUP BY s.id");
		$result = $query->result();
		return $result;
	}

	function addStudent($data)
	{
		$this->db->insert('student', $data);

		$query = $this->db->query("SELECT id FROM student ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function updateStudent($data, $where)
	{
		$this->db->where($where);
        $this->db->update('student', $data);
	}

	function deleteStudent($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('student');
	}

	function getStudentPayment() {
		$this->db->select("py.id, py.method, py.number, py.bank, py.total, py.paydate, py.trfdate, 
						   pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, pd.explanation,
						   s.name, s.status, p.program");
		$this->db->from("paydetail pd");
		$this->db->join("payment py", "pd.paymentid = py.id", "inner");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		return $this->db->get();
	}
}

?>