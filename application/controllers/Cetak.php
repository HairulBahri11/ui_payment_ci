<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
class Cetak extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->load->view('cetak/demo');
	}

	// public function helpernya($phone, $message)
	// {
	// 	// Set the URL and API Key
	// 	$url_gateway = "https://demo.wanotif.site/api/v1/messages";
	// 	$api_key = getenv('API_KEY'); // Assuming you're using .env, or use directly

	// 	// Prepare the data for the POST request
	// 	$data = [
	// 		'recipient_type' => 'individual',
	// 		'to' => $phone,
	// 		'type' => 'text',
	// 		'text' => [
	// 			'body' => $message
	// 		]
	// 	];

	// 	// Initialize CURL
	// 	$ch = curl_init($url_gateway);

	// 	// Set CURL options
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER, [
	// 		'Authorization: ' . $api_key,
	// 		'Content-Type: application/json',
	// 	]);
	// 	curl_setopt($ch, CURLOPT_POST, true);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

	// 	// Execute the CURL request and get the response
	// 	$response = curl_exec($ch);

	// 	// Check for CURL errors
	// 	if (curl_errno($ch)) {
	// 		return 'CURL Error: ' . curl_error($ch);
	// 	}

	// 	// Close the CURL session
	// 	curl_close($ch);

	// 	// Return the response
	// 	return json_decode($response, true); // Decode the JSON response
	// }


	public function printprivate($id = 1)
	{
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printprivate', $data);
	}

	public function printregular($id = 1)
	{
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printreguler', $data);
	}

	public function printother($id = 1)
	{
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printother', $data);
	}

	public function printregular_parent($id = 1)
	{
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printreguler-parent', $data);
	}

	public function printprivate_parent($id = 1)
	{
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printprivate-parent', $data);
	}

	public function printother_parent($id = 1)
	{
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printother-parent', $data);
	}
}
