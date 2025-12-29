<?php
//File products_model.php
class Mteacher extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function index()
	{
		$this->db->select('*');
		$this->db->from('teacher');
		$this->db->order_by('id', 'asc');
		return $this->db->get();
	}


	function store($data)
	{
		$this->db->insert('teacher', $data);

		$query = $this->db->query("SELECT id FROM teacher ORDER BY id DESC LIMIT 1");
		$result = $query->row_array();
		return $result;
	}

	function edit($id)
	{
		$this->db->select('*');
		$this->db->from('teacher');
		$this->db->where('id', $id);
		return $this->db->get();
	}

	function update($data, $id)
	{
	    
	    
		$this->db->where('id', $id);
		$this->db->update('teacher', $data);
	}

	function destroy($id)
	{   
		$this->db->where('id', $id);
		$this->db->delete('teacher');
	}

	function activateUser($data, $where)
	{
		$this->db->from('teacher');
		$this->db->where($where);
		$result = $this->db->update('teacher', $data);
		return $result;
	}
}
