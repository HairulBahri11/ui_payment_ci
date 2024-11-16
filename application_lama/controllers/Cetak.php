<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cetak extends CI_Controller  {
	function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('cetak/demo');
	}

	public function printprivate($id=1){
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printprivate',$data);
	}

	public function printregular($id=1){
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printreguler',$data);
	}

	public function printother($id=1){
		$data['pay'] = $this->db->query("select id,username,method,number,bank,total,DATE_FORMAT(paydate,'%b %y')paydate,date_format(paytime,'%d/%m/%Y %h:%i:%s')paytime,date_format(trfdate,'%d/%m')trfdate from payment where id = $id")->row(0);
		$data['id'] = $id;
		$this->load->view('cetak/printother',$data);
	}
}
?>
