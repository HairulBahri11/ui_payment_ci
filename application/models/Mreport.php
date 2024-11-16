<?php
//File products_model.php
class Mreport extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getExpense($startdate, $enddate)
	{
		//select semua data yang ada pada table msProduct $this--->db->select("*");
		$this->db->select("ed.id, ex.total, ex.entrydate, 
						   ed.expenseid, ed.category, ed.expdate, ed.amount, ed.explanation");
		$this->db->from("expdetail ed");
		$this->db->join("expense ex", "ed.expenseid = ex.id", "inner");
		$this->db->where('entrydate >=', $startdate);
		$this->db->where('entrydate <=', $enddate);
		$this->db->order_by('entrydate', 'asc');

		// $this->db->select("*");
		// $this->db->from("expdetail");
		// $this->db->where('expdate >=', $startdate);
		// $this->db->where('expdate <=', $enddate);
		// $this->db->order_by('expdate', 'asc');
		return $this->db->get();
	}

	function getLatePayment($month, $year)
	{
		// $query = $this->db->query("SELECT s.id, s.name, s.phone, s.birthday, s.condition, s.adjusment, p.program, p.level, p.course, py.method, MAX(pd.monthpay) as monthpay
		// FROM student s
		// LEFT OUTER JOIN price p ON s.priceid = p.id
		// LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
		// LEFT OUTER JOIN payment py ON pd.paymentid = py.id
		// WHERE s.status = 'ACTIVE'

		// AND p.level <> 'Private'
		// GROUP BY s.id");
		$query = $this->db->query("SELECT s.id, s.name, s.phone, s.birthday, s.condition, s.adjusment, p.program, p.level, p.course, py.method, (CASE WHEN MAX(pd.monthpay) IS NULL THEN STR_TO_DATE('0,0,0000','%d,%m,%Y') ELSE MAX(pd.monthpay) END) as monthpay
								   FROM student s
								   LEFT OUTER JOIN price p ON s.priceid = p.id
								   LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
								   LEFT OUTER JOIN payment py ON pd.paymentid = py.id
								   WHERE s.status = 'ACTIVE'
								   AND p.level <> 'Private'
								   GROUP BY s.id  
              					   HAVING monthpay < '" . $year . "-" . $month . "-1'
								ORDER BY `monthpay` DESC, s.name ASC");
		$result = $query->result();
		return $result;
	}

	function getGeneral($startdate, $enddate)
	{
		$this->db->select("py.id, py.method, py.number, py.bank, py.total, py.paydate, py.trfdate, 
						   pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, pd.explanation,
						   s.name, s.status, p.program");
		$this->db->from("paydetail pd");
		$this->db->join("payment py", "pd.paymentid = py.id", "inner");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->order_by('id', 'asc');
		$this->db->where('py.paydate >=', $startdate);
		$this->db->where('py.paydate <=', $enddate);
		return $this->db->get()->result();
	}

	function getDetail($startdate, $enddate)
	{
		$this->db->select("py.id, py.method, py.number, py.bank, py.total, py.paydate, py.trfdate, 
						   pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, pd.explanation,
						   s.name, s.status, p.program");
		$this->db->from("paydetail pd");
		$this->db->join("payment py", "pd.paymentid = py.id", "inner");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->order_by('id', 'asc');
		$this->db->where('py.paydate >=', $startdate);
		$this->db->where('py.paydate <=', $enddate);
		return $this->db->get()->result();
	}

	function getTransaction($startdate, $enddate)
	{
		//select semua data yang ada pada table msProduct $this--->db->select("*");
		// $this->db->select("s.name, py");
		// $this->db->from("student s");
		// $this->db->join("price p", "s.priceid = p.id", "left");
		// $this->db->join("paydetail pd", "s.id = pd.id", "left");
		// $this->db->join("payment py", "pd.paymentid = py.id", "left");
		// $this->db->order_by('py.id', 'asc');
		// $this->db->where('py.paydate >=', $startdate);
		// $this->db->where('py.paydate <=', $enddate);
		// return $this->db->get();

		// $this->db->select("*");
		// $this->db->from("payment");
		// $this->db->order_by('id', 'asc');
		// $this->db->where('paydate >=', $startdate);
		// $this->db->where('paydate <=', $enddate);
		// return $this->db->get();

		$query = $this->db->query("SELECT s.name, py.*, p.program, pd.explanation, p.level, pd.monthpay, 
		(SELECT SUM(amount) FROM paydetail WHERE category ='AGENDA' AND studentid = s.id AND paymentid = py.id) as agenda,
		(SELECT SUM(amount) FROM paydetail WHERE category ='COURSE' AND studentid = s.id AND paymentid = py.id) as course,
		(SELECT SUM(amount) FROM paydetail WHERE category ='POINT BOOK' AND studentid = s.id AND paymentid = py.id) as point_book,
		(SELECT SUM(amount) FROM paydetail WHERE category ='BOOK' AND studentid = s.id AND paymentid = py.id) as book,
		(SELECT SUM(amount) FROM paydetail WHERE category ='REGISTRATION' AND studentid = s.id AND paymentid = py.id) as regist,
		(SELECT SUM(amount) FROM paydetail WHERE category ='EXERCISE' AND studentid = s.id AND paymentid = py.id) as exercise,
		
		(SELECT SUM(amount) FROM paydetail WHERE paymentid = py.id) as grandTotal
								   FROM student s
								   LEFT OUTER JOIN price p ON s.priceid = p.id
								   LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
								   LEFT OUTER JOIN payment py ON pd.paymentid = py.id
								   WHERE py.paydate >= '" . $startdate . "'
								   AND py.paydate <= '" . $enddate . "'
								   GROUP BY py.id");
		$result = $query->result();
		return $result;
	}

	function getDetailPayment($startdate, $enddate)
	{
		$this->db->select("py.id, py.method, py.number, py.bank, py.total, py.paydate, py.trfdate, 
						   pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, pd.explanation,
						   s.name, s.status, p.program");
		$this->db->from("paydetail pd");
		$this->db->join("payment py", "pd.paymentid = py.id", "inner");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('py.paydate >=', $startdate);
		$this->db->where('py.paydate <=', $enddate);
		return $this->db->get();
	}

	function getAllPayment($startdate, $enddate)
	{
		$query = $this->db->query("SELECT * FROM payment WHERE paydate >= '" . $startdate . "'
		AND paydate <= '" . $enddate . "'");
		$result = $query->result();
		return $result;
	}
}
