<?php
	//File products_model.php
	class MExpdetail extends CI_Model  {
		function __construct() { parent::__construct(); } function getAllExpdetail($id) {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
        $this->db->select("*");
		$this->db->from("expdetail");
		return $this->db->get();
	}

	function getExpdetailById($id)
	{
		$this->db->select("*");
		$this->db->from("expdetail");
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function getExpdetailByExpenseId($id)
	{
		$this->db->select("expdetail.*, tbl_akun.id_akun, tbl_akun.nama_akun");
		$this->db->from("expdetail");
		$this->db->join("tbl_akun", "expdetail.id_akun = tbl_akun.id_akun", "left"); // Adjust 'akun_id' to match your foreign key
		$this->db->where('expdetail.expenseid', $id);
		return $this->db->get();
	}

	function addExpdetail($data)
	{
		$this->db->insert('expdetail', $data);

		$query = $this->db->query("SELECT id FROM expdetail ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function updateExpdetail($data, $where)
	{
		$this->db->where($where);
        $this->db->update('expdetail', $data);
	}

	function deleteExpdetail($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('expdetail');
	}

	function deleteJournal($expdetail_id)
	{
		$this->db->where('expdetail_id', $expdetail_id);
		$this->db->delete('tbl_trx_akuntansi');
	}

	function deleteExpdetailByExpenseId($id)
	{
		$this->db->where('expenseid', $id);
        $this->db->delete('expdetail');
	}
}

?>
