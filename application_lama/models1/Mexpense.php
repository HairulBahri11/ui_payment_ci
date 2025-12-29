<?php
	//File products_model.php
	class MExpense extends CI_Model  {
		function __construct() { parent::__construct(); } function getAllExpense() {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
        $this->db->select("*");
		$this->db->from("expense");
		return $this->db->get();
	}

	function getExpenseById($id)
	{
		$this->db->select("*");
		$this->db->from("expense");
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function addExpense($data)
	{
		$this->db->insert('expense', $data);

		$query = $this->db->query("SELECT id FROM expense ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function updateExpense($data, $where)
	{
		$this->db->where($where);
        $this->db->update('expense', $data);
	}

	function deleteExpense($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('expense');
	}

	function getUncompleteExpense()
	{
		$query = $this->db->query("SELECT *
								   FROM expense
								   WHERE total = 0");
		$result = $query->result();
		return $result;
	}
}

?>