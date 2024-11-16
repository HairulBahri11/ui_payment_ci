<?php
	//File products_model.php
	class Mvoucher extends CI_Model  {
		function __construct() { parent::__construct(); } function getAllVoucher() {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
        $this->db->select("*");
		$this->db->from("voucher");
		return $this->db->get();
	}

	function getAllVoucherYes()
	{
		$this->db->select("*");
		$this->db->from("voucher");
		$this->db->where('isused', 'YES');
		return $this->db->get();
	}

	function getVoucherById($id)
	{
		$this->db->select("*");
		$this->db->from("voucher");
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function addVoucher($data)
	{
		$this->db->insert('voucher', $data);

		$query = $this->db->query("SELECT id FROM voucher ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function updateVoucher($data, $where)
	{
		$this->db->where($where);
        $this->db->update('voucher', $data);
	}

	function deleteVoucher($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('voucher');
	}
}

?>