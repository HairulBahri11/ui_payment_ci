<?php
//File products_model.php
class Mstudent extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function getAllStudent()
	{
		//select semua data yang ada pada table msProduct $this--->db->select("*");
		$this->db->select("s.id as sid, s.priceid,s.branch_id, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, lpr.id, p.program, lpr.course, lpr.level, lpr.monthpay");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "left outer");
		$this->db->join("last_payment_regular lpr", "s.id = lpr.id_student", "left outer");
		$this->db->where("is_complete", "1");
		if ($this->session->userdata('userid') != 'superadmin') {
			$this->db->where('s.branch_id', $this->session->userdata('branch'));
		}
		$this->db->order_by('sid', 'asc');
		return $this->db->get();
	}

	function getAllActive()
	{
		$this->db->select("s.id as sid, s.priceid,s.branch_id, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('s.status =', 'ACTIVE');
		$this->db->order_by('sid', 'asc');
		if ($this->session->userdata('userid') != 'superadmin') {
			$this->db->where('s.branch_id', $this->session->userdata('branch'));
		}
		return $this->db->get();
	}

	function getAllRegular()
	{
		$this->db->select("s.id as sid, s.priceid, s.branch_id, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level, MAX(pd.monthpay) as monthpay");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "left outer");
		$this->db->join("paydetail pd", "s.id = pd.studentid", "left outer");
		$this->db->where('p.level !=', 'Private');
		$this->db->where('s.status =', 'ACTIVE');
		if ($this->session->userdata('userid') != 'superadmin') {
			$this->db->where('s.branch_id', $this->session->userdata('branch'));
		}
		$this->db->group_by('s.id');
		$this->db->order_by('s.id', 'asc');
		return $this->db->get();
	}

	function getAllPrivate()
	{

		$this->db->select("s.id as sid, s.priceid, s.branch_id, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, p.course, p.level");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('p.level =', 'Private');
		$this->db->where('s.status =', 'ACTIVE');


		if ($this->session->userdata('userid') != 'superadmin') {
			$this->db->where('s.branch_id', $this->session->userdata('branch'));
		}
		$this->db->order_by('s.id', 'asc');
		return $this->db->get();
	}

	function getStudentById($id)
	{
		$this->db->select("s.id as sid, s.priceid, s.branch_id, s.name, s.phone, s.birthday, s.entrydate, s.adjusment, s.balance, s.penalty, s.status, s.condition, p.id, p.program, s.note");
		$this->db->from("student s");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where('s.id', $id);
		return $this->db->get();
	}

	/*function getLatePaymentStudent()
	{
		$query = $this->db->query("SELECT s.id, s.name, s.condition, s.adjusment, p.program, p.course, py.method, pd.id as id_detail_pd,  MAX(pd.monthpay) as monthpay, p.level
								   FROM student s
								   LEFT OUTER JOIN price p ON s.priceid = p.id
								   LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
								   LEFT OUTER JOIN payment py ON pd.paymentid = py.id
								   
								   GROUP BY s.id");
		$result = $query->result();
		return $result;
	}*/


	function getLatePaymentStudentPrivate()
	{
		$query = $this->db->query("SELECT s.id, s.name, s.condition, s.adjusment, p.program, p.course, py.method, pd.id as id_detail_pd,  MAX(pd.monthpay) as monthpay, p.level
								   FROM student s
								   LEFT OUTER JOIN price p ON s.priceid = p.id
								   LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
								   LEFT OUTER JOIN payment py ON pd.paymentid = py.id
								   WHERE p.level = 'Private'
								   GROUP BY s.id");
		$result = $query->result();
		return $result;
	}
	function getLatePaymentStudent()
	{
		$query = $this->db->query("SELECT s.id, s.name, s.condition, s.adjusment, lpr.program, lpr.course, lpr.monthpay
								   FROM `last_payment_regular` lpr
								   LEFT OUTER JOIN student s ON lpr.id_student=s.id
								   WHERE s.status = 'ACTIVE'
								   AND lpr.level <> 'Private'
								   ");
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

	function getStudentPayment()
	{
		$this->db->select("py.id, py.method, py.number, py.bank, py.total, py.paydate, py.trfdate, 
						   pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, pd.explanation,
						   s.name, s.status, p.program");
		$this->db->from("paydetail pd");
		$this->db->join("payment py", "pd.paymentid = py.id", "inner");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where("paydate BETWEEN '2019-07-01' AND '2019-09-31'");
		return $this->db->get();
	}
	function getStudentDetailPayment($id)
	{
		$this->db->select("py.id, py.method, py.number, py.bank, py.total, py.paydate, py.trfdate, 
						   pd.paymentid, pd.studentid, pd.voucherid, pd.category, pd.monthpay, pd.amount, pd.explanation,
						   s.name, s.status, p.program");
		$this->db->from("paydetail pd");
		$this->db->join("payment py", "pd.paymentid = py.id", "inner");
		$this->db->join("student s", "pd.studentid = s.id", "inner");
		$this->db->join("price p", "s.priceid = p.id", "inner");
		$this->db->where("s.id", $id);
		return $this->db->get();
	}

	function getOnlineStudent()
	{
		$this->db->select("
			student.*,
			staff.name as staff_name,
			price.program as result,
			dayone.day as dayone,
			daytwo.day as daytwo,
			teacher.name as teacher_name,
			GROUP_CONCAT(parents.name SEPARATOR ', ') as parent_names,
			GROUP_CONCAT(parents.no_hp SEPARATOR ', ') as parent_phones
		");
		$this->db->from("student");
		$this->db->join("teacher", "student.id_teacher = teacher.id", "left");
		$this->db->join("staff", "student.id_staff = staff.id", "left");
		$this->db->join("price", "student.priceid = price.id", "left");
		$this->db->join("day as dayone", "student.day1 = dayone.id", "left");
		$this->db->join("day as daytwo", "student.day2 = daytwo.id", "left");
		$this->db->join("parent_students", "student.id = parent_students.student_id", "left");
		$this->db->join("parents", "parents.id = parent_students.parent_id", "left");
		$this->db->where('student.status =', 'ACTIVE');
		$this->db->where('is_online =', 1);
		$this->db->where("is_prospective_done", "0");
		$this->db->group_by("student.id");
		$this->db->order_by('student.id', 'asc');

		if ($this->session->userdata('level') == '3') {
			$this->db->where('student.branch_id', $this->session->userdata('branch'));
		}

		return $this->db->get();
	}


	function getInactiveStudent()
	{
		$this->db->select("*");
		$this->db->from("student_inactive");
		$this->db->order_by('studentid', 'asc');
		return $this->db->get();
	}

	function addMutasi($data)
	{
		$this->db->insert('mutasi_siswa', $data);
	}

	function getStudentLatePayment()
	{
		$query = $this->db->query("
        SELECT s.id, s.name, p.program, s.status, s.phone, t.name as teacher_name, pd.category,
               pd.id AS id_detail_pd,  
               MAX(pd.monthpay) AS monthpay, 
               p.level
        FROM student s
        LEFT OUTER JOIN price p ON s.priceid = p.id
        LEFT OUTER JOIN paydetail pd ON s.id = pd.studentid
        LEFT OUTER JOIN teacher t ON s.id_teacher = t.id
        WHERE s.status = 'ACTIVE'
          AND pd.category = 'COURSE'
          AND p.level <> 'Private'
          AND s.course_time IS NOT NULL
        GROUP BY s.id
        HAVING MAX(pd.monthpay) < CURDATE()  -- Mengambil pembayaran sebelum bulan saat ini
        AND YEAR(MAX(pd.monthpay)) < YEAR(CURDATE())  -- Menambahkan filter agar pembayaran sebelum tahun saat ini
        OR (YEAR(MAX(pd.monthpay)) = YEAR(CURDATE()) AND MONTH(MAX(pd.monthpay)) < MONTH(CURDATE()))  -- Menambahkan filter agar pembayaran sebelum bulan ini dalam tahun yang sama
        ORDER BY `monthpay` ASC
    ");

		return $query->result();
	}




	function getStudentReview()
	{
		$query = $this->db->query("
	SELECT rs.id as id_review, s.id, s.name, rs.program, s.status, rs.date_inactive, cr.category_name
		   from student_review rs
		   join student s on rs.student_id = s.id
		   join category_review cr on rs.review_id = cr.id
		   ORDER BY rs.date_inactive ASC
		   ");

		return $query->result();
	}
}
