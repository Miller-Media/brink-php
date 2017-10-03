<?php

namespace MillerMedia\Brink;

class Brink_API {
	
	public $access_token;
	public $user_id;
	private $api_baseurl;
	
	public function __construct() {
		$this->api_baseurl = "http://api.joinbrink.com/v1/";
	}

	private function send($args) {
		
		$custom_request = 'GET';
		$data = array();
		extract($args);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom_request);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);

		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;
	}
	
	public function is_active_token($token) {
		$token_parts = explode('.', $token);
		$token_data = json_decode(base64_decode($token_parts[1]));
		if ($token_data->exp > time()) return true;
		else return false;
	}
	
	public function create_user($data) {
		
		// $data (array) attributes:
		// first_name,
		// last_name,
		// email,
		// username,
		// password
		
		$args = array(
			'url' => $this->api_baseurl.'users',
			'custom_request' => 'PUT',
			'data' => $data,
			'http_header' => array("Content-Type: application/json")
		);
		$response = $this->send($args);
		
		return json_decode($response);
	}
	
	public function get_user() {
		
		$args = array(
			'url' => $this->api_baseurl."users/".$this->user_id,
			'http_header' => array(
				"Content-Type: application/json",
				"Authorization: JWT ".$this->access_token
			)
		);
		$response = $this->send($args);
		
		return json_decode($response);
		
	}
	
	public function login($data) {
		
		// $data (array) attributes:
		// username,
		// password

		$args = array(
			'url' => $this->api_baseurl."login",
			'custom_request' => 'POST',
			'data' => $data,
			'http_header' => array(
				"Content-Type: application/json"
			)
		);
		$response = $this->send($args);
		
		return json_decode($response);
	
	}
	
	public function get_all_flights() {

		$args = array(
			'url' => $this->api_baseurl."flights",
			'http_header' => array(
				"Content-Type: application/json",
				"Authorization: JWT ".$this->access_token
			)
		);
		$response = $this->send($args);
		
		return json_decode($response);
	}
	
	public function get_flight($data) {
		
		// $data (array) attributes:
		// flight_id

		$args = array(
			'url' => $this->api_baseurl."flights/".$data['flight_id'],
			'http_header' => array(
				"Content-Type: application/json",
				"Authorization: JWT ".$this->access_token
			)
		);
		$response = $this->send($args);
		
		return json_decode($response);
		
	}
	
	public function create_flight() {

		$args = array(
			'url' => $this->api_baseurl."flights",
			'custom_request' => 'PUT',
			'http_header' => array(
				"Content-Type: application/json",
				"Authorization: JWT ".$this->access_token
			)
		);
		$response = $this->send($args);
		
		return json_decode($response);
	}
	
	public function get_flight_data($data) {
		
		// $data (array) attributes:
		// flight_id,
		// prop (array) attributes:
			// page,
			// per_page

		$args = array(
			'url' => $this->api_baseurl."flights/".$data['flight_id']."/data",
			'custom_request' => 'POST',
			'data' => $data['prop'],
			'http_header' => array(
				"Content-Type: application/json",
				"Authorization: JWT ".$this->access_token
			)
		);
		$response = $this->send($args);
		
		return json_decode($response);
	}
	
	public function create_flight_data_record($data) {

		// $data (array) attributes:
		// flight_id,
		// prop (array) attributes:
			// timestamp,
			// altitude,
			// barometricPressure,
			// coordinateX,
			// coordinateY,
			// temperature

		$args = array(
			'url' => $this->api_baseurl."flights/".$data['flight_id']."/data",
			'custom_request' => 'PUT',
			'data' => $data['prop'],
			'http_header' => array(
				"Content-Type: application/json",
				"Authorization: JWT ".$this->access_token
			)
		);
		$response = $this->send($args);
		
		return json_decode($response);
	
	}
	
}