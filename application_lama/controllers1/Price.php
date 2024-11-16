<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Price extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("mprice"); 
		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	public function index()
	{
		$data['listPrice'] = $this->mprice->getAllPrice(); 
		$this->load->view('v_header');
		$this->load->view('v_pricelist', $data); 
		$this->load->view('v_footer');
	}

	public function addPrice()
	{
		$this->load->view('v_header');
		$this->load->view('v_priceadd');
		$this->load->view('v_footer');
	}

	public function addPriceDb()
	{
		// $date = date('Y-m-d');

		// $var = $this->input->post('startdate');
		// if($var != "") {
		// 	$parts = explode('/',$var);
		// 	$startdate = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
		// } else{
		// 	$startdate = "";
		// }

		$pointbook = $this->input->post('pointbook');
		$registration = $this->input->post('registration');
		$book = $this->input->post('book');
		$agenda = $this->input->post('agenda');
		$course = $this->input->post('course');
		$priceperday = $this->input->post('priceperday');

		$order   = array("Rp ", ".");
		$replace = "";

		$pointbook = str_replace($order, $replace, $pointbook);
		$registration = str_replace($order, $replace, $registration);
		$book = str_replace($order, $replace, $book);
		$agenda = str_replace($order, $replace, $agenda);
		$course = str_replace($order, $replace, $course);
		$priceperday = str_replace($order, $replace, $priceperday);

		$data = array(
				'program' => $this->input->post('program'),
				'level' => $this->input->post('level'),
				'pointbook' => $pointbook,
				'registration' => $registration,
				'book' => $book,
				'agenda' => $agenda,
				'course' => $course,
				'priceperday' => $priceperday
				);
		$latestRecord = $this->mprice->addPrice($data);

		redirect(base_url("price"));
	}

	public function updatePrice($id)
	{
		$data['price'] = $this->mprice->getPriceById($id); 
		
		$this->load->view('v_header');
		$this->load->view('v_priceedit', $data);
		$this->load->view('v_footer');
	}

	public function updatePriceDb()
	{
		$pointbook = $this->input->post('pointbook');
		$registration = $this->input->post('registration');
		$book = $this->input->post('book');
		$agenda = $this->input->post('agenda');
		$course = $this->input->post('course');
		$priceperday = $this->input->post('priceperday');

		$order   = array("Rp ", ".");
		$replace = "";

		$pointbook = str_replace($order, $replace, $pointbook);
		$registration = str_replace($order, $replace, $registration);
		$book = str_replace($order, $replace, $book);
		$agenda = str_replace($order, $replace, $agenda);
		$course = str_replace($order, $replace, $course);
		$priceperday = str_replace($order, $replace, $priceperday);

		$data = array(
				'program' => $this->input->post('program'),
				'level' => $this->input->post('level'),
				'pointbook' => $pointbook,
				'registration' => $registration,
				'book' => $book,
				'agenda' => $agenda,
				'course' => $course,
				'priceperday' => $priceperday
				);
				
		$where['id'] = $this->input->post('id');
		$this->mprice->updatePrice($data, $where); 

		redirect(base_url("price"));
	}

	public function deletePriceDb($id)
	{
		$this->mprice->deletePrice($id); 
		redirect(base_url("price"));
	}
}
?>