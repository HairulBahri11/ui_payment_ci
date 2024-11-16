<?php
//File products_model.php
class Mstaff extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->order_by('id', 'asc');
		return $this->db->get();
	}


	function store($data)
	{
		$this->db->insert('staff', $data);

		$query = $this->db->query("SELECT id FROM staff ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function edit($id)
	{
		$this->db->select('*');
		$this->db->from('staff');
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function update($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update('staff', $data);
	}

	function destroy($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('staff');
	}
}
