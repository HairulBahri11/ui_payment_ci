<?php
//File products_model.php
class Mdashboard extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function getTotalPayment()
	{
		$query = $this->db->query("SELECT SUM(total) AS totalpay FROM payment WHERE YEAR(paydate) = YEAR(now())");
		$result = $query->row_array();
		return $result;

		// 		$this->db->select('COALESCE(SUM(pd.amount), 0) as totalpay');
		// $this->db->from('payment as p');
		// $this->db->join('paydetail as pd', 'p.id = pd.paymentid');
		// $this->db->where('YEAR(p.paydate) = YEAR(NOW())'); // Koreksi di sini
		// $query = $this->db->get(); // Pastikan untuk memanggil get()
		// $result = $query->row_array();
		// return $result;




		// select sum(total),MONTHNAME(paydate) from payment group by MONTH(paydate)
	}

	function getTotalExpense()
	{
		$query = $this->db->query("SELECT SUM(total) AS totalexp FROM expense WHERE YEAR(entrydate) = YEAR(now())");
		$result = $query->row_array();
		return $result;
	}

	function getActiveStudent()
	{
		$query = $this->db->query("SELECT COUNT(*) AS studentnum FROM student WHERE status = 'ACTIVE' AND course_time IS NOT NULL");
		$result = $query->row_array();
		return $result;
	}

	function getLatePayment($year, $month)
	{
		// $query = $this->db->query("SELECT s.id, s.name, s.phone, s.birthday, s.condition, s.adjusment, p.program, p.level, p.course, py.method, MAX(pd.monthpay) as monthpay
		// FROM student s
		// LEFT OUTER JOIN price p ON s.priceid = p.id
		// LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
		// LEFT OUTER JOIN payment py ON pd.paymentid = py.id
		// WHERE s.status = 'ACTIVE'
		// AND p.level <> 'Private'
		// GROUP BY s.id");
		$query = $this->db->query("SELECT COUNT(*) AS jmlLatePayment FROM (SELECT s.id, s.name, s.phone, s.birthday, s.condition, s.adjusment, p.program, p.level, p.course, py.method, (CASE WHEN MAX(pd.monthpay) IS NULL THEN STR_TO_DATE('0,0,0000','%d,%m,%Y') ELSE MAX(pd.monthpay) END) as monthpay
								   FROM student s
								   LEFT OUTER JOIN price p ON s.priceid = p.id
								   LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
								   LEFT OUTER JOIN payment py ON pd.paymentid = py.id
								   WHERE s.status = 'ACTIVE'
								   AND s.course_time IS NOT NULL
								   AND p.level <> 'Private'
								   GROUP BY s.id  
              					   HAVING monthpay < '" . $year . "-" . $month . "-1') Qry");

		$result = $query->row_array();
		return $result;
	}

	function getMonthlyPayment()
	{
		$query = $this->db->query("SELECT SUM(total) AS totalpay, MONTHNAME(paydate) AS nmonth FROM payment GROUP BY MONTH(paydate)");
		$result = $query->result();
		return $result;
	}

	function getMonthlyExpense()
	{
		$query = $this->db->query("SELECT SUM(total) AS totalexp, MONTHNAME(entrydate) AS nmonth FROM expense GROUP BY MONTH(entrydate)");
		$result = $query->result();
		return $result;
	}
}
