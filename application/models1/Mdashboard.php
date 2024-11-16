<?php
	//File products_model.php
	class Mdashboard extends CI_Model  {
		function __construct() { parent::__construct(); } 
		
	function getTotalPayment()
	{
		$query = $this->db->query("SELECT SUM(total) AS totalpay FROM payment WHERE YEAR(paydate) = YEAR(now())");
		$result = $query->row_array();
		return $result;

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
		$query = $this->db->query("SELECT COUNT(*) AS studentnum FROM student WHERE status = 'ACTIVE'");
		$result = $query->row_array();
		return $result;
	}

	function getLatePayment()
	{
		$query = $this->db->query("SELECT s.id, s.name, s.phone, s.birthday, s.condition, s.adjusment, p.program, p.level, p.course, py.method, MAX(pd.monthpay) as monthpay
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

?>