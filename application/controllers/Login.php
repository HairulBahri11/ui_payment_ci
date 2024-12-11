<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller  {
	function __construct(){
		parent::__construct();
		$this->load->model("muser");
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	public function index()
	{
		$this->load->view('v_login');
	}

	public function login_old()
	{
		$where = array(
				'userid' => $this->input->post('userid'),
				'password' =>$this->input->post('password')
				);

		$cek = $this->muser->cekLogin($where)->num_rows();
		$user = $this->muser->getUsername($where);
		
		if($cek > 0){
			$data_session = array(
				'userid' => $user["userid"],
				'nama' => $user["name"],
				'level' => $user["levelid"],
				'position' => $user["levelname"],
				'branch' =>$user["branch_id"],
				'status' => "login"
				);
			$this->session->set_userdata($data_session);
			redirect(base_url("dashboard"));
		}else{
			$userid = $this->input->post('userid');
			$password = $this->input->post('password');
			if(($userid != "") && ($password != "")) {
				$data = new stdClass();
				$data->error = 'Wrong username or password.';
				$this->load->view('v_login', $data);
			} else{
				$this->load->view('v_login');
			}
		}
	}

	
	
	public function login() {
		$userid = $this->input->post('userid');
		$password = $this->input->post('password');
	
		// Validasi masukan
		if (empty($userid) || empty($password)) {
			$data = new stdClass();
			$data->error = 'Please enter both username and password.';
			$this->load->view('v_login', $data);
			return;
		}
	
		// Ambil data pengguna dari database
		$this->db->where('userid', $userid);
		$result = $this->db->get('user')->row_array(); // Ambil satu baris data sebagai array
	
		if ($result) {
			// Verifikasi password yang diinputkan
			$hashed_password = $result['password'] ?? ''; // Pastikan tidak null
			if (password_verify($password, $hashed_password)) {
				// Jika password benar, buat sesi
				$data_session = array(
					"userid" => $result['userid'],
					"nama" => $result['name'],
					"level" => $result['levelid'],
					"position" => $result['levelname'],
					"branch" => $result['branch_id'],
					"status" => "login",
				);
				$this->session->set_userdata($data_session);
	
				// Redirect ke dashboard
				redirect(base_url("dashboard"));
			} else {
				// Jika password salah, tampilkan pesan error
				$data = new stdClass();
				$data->error = 'Wrong username or password.';
				$this->load->view('v_login', $data);
			}
		} else {
			// Jika pengguna tidak ditemukan, tampilkan pesan error
			$data = new stdClass();
			$data->error = 'Wrong username or password.';
			$this->load->view('v_login', $data);
		}
	}
	

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url("login"));
	}
}
?>