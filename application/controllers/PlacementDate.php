<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class PlacementDate extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mplacement_date');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['data'] = $this->Mplacement_date->get_all_data();
        $this->load->view('v_header');
        $this->load->view('v_placement_date', $data);
        $this->load->view('v_footer');
    }

    public function create()
    {
        $this->load->view('v_header');
        $this->load->view('v_placement_date_create');
        $this->load->view('v_footer');
    }

    public function store()
    {
        date_default_timezone_set("Asia/Jakarta");
        $data = array(
            'student_name' => $this->input->post('name'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'whatsapp' => $this->input->post('whatsapp'),
            'status' => 'incomplete',
            'created_at' => date('Y-m-d H:i:s'),
        );
        $this->db->insert('placement_date', $data);
        $this->session->set_flashdata('alert', 'Placement Test Date added successfully');
        redirect(base_url('PlacementDate'));
    }

    public function edit($id){
        $data['data'] = $this->Mplacement_date->get_by_id($id);
        $this->load->view('v_header');
        $this->load->view('v_placement_date_edit', $data);
        $this->load->view('v_footer');
    }

    public function update(){
        date_default_timezone_set("Asia/Jakarta");
        $data = array(
            'student_name' => $this->input->post('name'),
            'date' => $this->input->post('date'),
            'time' => $this->input->post('time'),
            'whatsapp' => $this->input->post('whatsapp'),
        );
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('placement_date', $data);
        $this->session->set_flashdata('alert', 'Placement Test Date updated successfully');
        redirect(base_url('PlacementDate'));
    }

    public function updateStatus($id){
        date_default_timezone_set("Asia/Jakarta");
        $data = array(
            'status' => 'complete',
        );
        $this->db->where('id', $id);
        $this->db->update('placement_date', $data);
        $this->session->set_flashdata('alert', 'Placement Test Date status updated successfully');
        redirect(base_url('PlacementDate'));
    }
}
