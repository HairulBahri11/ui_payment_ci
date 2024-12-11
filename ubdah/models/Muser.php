<?php
	//File products_model.php
	class Muser extends CI_Model  {
		function __construct() { parent::__construct(); } function cekLogin($where) {
		return $this->db->get_where('user', $where);
	}

	function getUsername($where)
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where($where);
		$query = $this->db->get();	

		$result = $query->row_array();
		return $result;
	}

	function getAllUser()
	{
		$this->db->select("*");
		$this->db->from("user");
		return $this->db->get();
	}

	function getUserById($id)
	{
		$this->db->select("*");
		$this->db->from("user");
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function addUser($data)
	{
		$this->db->insert('user', $data);
	}

	function updateUser($data, $where)
	{
		$this->db->where($where);
        $this->db->update('user', $data);
	}

	function deleteUser($id)
	{
		$this->db->where('id', $id);
        $this->db->delete('user');
	}
	

	function usernya($userid){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('userid', $userid);
		return $this->db->get()->row_array(); // Meng
	}
}

?>