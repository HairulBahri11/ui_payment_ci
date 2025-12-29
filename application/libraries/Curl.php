<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Curl
{
	private $ci;

	public function __construct()
	{
		$this->ci = &get_instance();
	}

	public function create($url)
	{
		$this->ci->curl_handle = curl_init($url);
	}

	public function http_header($headers)
	{
		curl_setopt($this->ci->curl_handle, CURLOPT_HTTPHEADER, $headers);
	}

	public function option($option, $value)
	{
		curl_setopt($this->ci->curl_handle, $option, $value);
	}

	public function execute()
	{
		$result = curl_exec($this->ci->curl_handle);
		if (curl_errno($this->ci->curl_handle)) {
			$this->error_code = curl_errno($this->ci->curl_handle);
			$this->error_string = curl_error($this->ci->curl_handle);
			curl_close($this->ci->curl_handle);
			return false;
		}
		curl_close($this->ci->curl_handle);
		return $result;
	}
}
