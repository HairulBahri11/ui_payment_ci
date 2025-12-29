<?php
	//File products_model.php
	class Mprice extends CI_Model  {
		function __construct() { parent::__construct(); } function getAllPrice() {
		//select semua data yang ada pada table msProduct $this--->db->select("*");
        $this->db->select("*");
		$this->db->from("price");
		return $this->db->get();
	}

	function getPriceById($id)
	{
		$this->db->select("*");
		$this->db->from("price");
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function getPriceRegular()
	{
		$this->db->select("*");
		$this->db->from("price");
		$this->db->where('program !=', 'Private');
		return $this->db->get();
	}

	function addPrice($data)
	{
		$this->db->insert('price', $data);

		$query = $this->db->query("SELECT id FROM price ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function updatePrice($data, $where)
	{
		$this->db->where($where);
        $this->db->update('price', $data);
	}

	function deletePrice($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('price');
	}
}

?>