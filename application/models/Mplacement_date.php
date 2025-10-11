<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mplacement_date extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get_all_data()
    {
        $this->db->select('*');
		$this->db->from('placement_date');
		$this->db->order_by('date', 'asc');
		return $this->db->get();
    }

   public function get_by_id($id){
       $this->db->select('*');
       $this->db->from('placement_date');
       $this->db->where('id', $id);
      // Mengembalikan objek baris tunggal (lebih disukai untuk edit)
        return $this->db->get()->row();
   }
}
