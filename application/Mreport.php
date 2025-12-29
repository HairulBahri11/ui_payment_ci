<?php
//
//$data['listTransaction'] = $this->mreport->getTransaction();
//		$data['listDetailPayment'] = $this->mreport->getDetailPayment(); 
		

	//File products_model.php
	class Mreport extends CI_Model  {
		function __construct() { parent::__construct(); } 
		
	function getExpense($startdate, $enddate) {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
		$this->db->select("ed.id, ex.total, ex.entrydate, 
						   ed.expenseid, ed.category, ed.expdate, ed.amount, ed.explanation");
		$this->db->from("expdetail ed");
		$this->db->join("expense ex", "ed.expenseid = ex.id", "inner");
		$this->db->where('ed.expdate >=', $startdate);
		$this->db->where('ed.expdate <=', $enddate);
		$this->db->order_by('ed.expdate', 'asc');

        // $this->db->select("*");
		// $this->db->from("expdetail");
		// $this->db->where('expdate >=', $startdate);
		// $this->db->where('expdate <=', $enddate);
		// $this->db->order_by('expdate', 'asc');
		return $this->db->get();
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

	function getGeneral($startdate, $enddate) {
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

	function getDetail($startdate, $enddate) {
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

	function getTransaction() {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
        $this->db->select("*");
		$this->db->from("payment");
		$this->db->where("paydate BETWEEN '2018-10-01' AND '2018-11-31'"); //sebelah sini ubahen ya
		//disini juga ya
		$this->db->order_by('id', 'asc');
		return $this->db->get();
	}

	function getDetailPayment() {
		$this->db->select("py.id, py.method, py.number, py.bank, py.total, py.paydate, py.trfdate, 
						   pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, pd.explanation,
						   s.name, s.status, p.program");
		$this->db->from("paydetail pd");
		$this->db->join("payment py", "pd.paymentid = py.id", "inner");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where("paydate BETWEEN '2018-10-01' AND '2018-11-31'"); //sebelah sini ubahen ya

		return $this->db->get();
	}

}

?>
