function send_request() {

	var request = new XMLHttpRequest();
	var url = 'http://api.joinbrink.com/v1/';
	var user_id = 14;
	var access_token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZGVudGl0eSI6MTQsImlhdCI6MTUwNTMzMDU2NSwibmJmIjoxNTA1MzMwNTY1LCJleHAiOjE1MzY4NjY1NjV9.pP0zSthVQQliNpQNe_uut5Qgf_BcBjLYGKXLHbcXNkU";
	
	//request.open('GET', 'http://api.joinbrink.com/v1/users/'+user_id);
	request.open('GET', 'http://dev.allsportdesigns.com/wp-content/themes/storefront-child/xhr.php');

	//request.setRequestHeader("Access-Control-Allow-Origin", "*");
	//request.setRequestHeader("Access-Control-Allow-Headers", "*");
	//request.setRequestHeader('Authorization', 'JWT '+access_token);

	request.onreadystatechange = function () {
	  if (this.readyState === 4) {
		console.log('Status:', this.status);
		console.log('Headers:', this.getAllResponseHeaders());
		console.log('Body:', this.responseText);
	  }
	};

	request.send();

}

/*function Brink_API() {
	
	//var this.access_token;
	//var this.user_id;
	this.api_baseurl = "http://api.joinbrink.com/v1/";
	
}*/

function Brink_API() {
	
	this.api_baseurl = "http://api.joinbrink.com/v1/";
	this.user_id = 14;
	this.access_token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZGVudGl0eSI6MTQsImlhdCI6MTUwNTMzMDU2NSwibmJmIjoxNTA1MzMwNTY1LCJleHAiOjE1MzY4NjY1NjV9.pP0zSthVQQliNpQNe_uut5Qgf_BcBjLYGKXLHbcXNkU';
	
	this.send = function(args) {
		
		var request_type = 'GET';
		var data = '';
		var http_header = {};
		//var url = args.url;
		var url = 'xhr.php';
		
		if (args.hasOwnProperty('request_type')) request_type = args.request_type;
		if (args.hasOwnProperty('data')) data = JSON.stringify(args.data);
		if (args.hasOwnProperty('http_header')) http_header = args.http_header;
		
		//console.log(request);
		//console.log(data);
		console.log(http_header);
		return false;
		
		var request = new XMLHttpRequest();
		request.open(request_type, url, false);
		if (http_header.length > 0) {
			
		}
		//request.setRequestHeader(http_header);
		request.onreadystatechange = function () {
			if (this.readyState === 4) {
				return;
				//console.log('Status:', this.status);
				//console.log('Headers:', this.getAllResponseHeaders());
				//console.log('Body:', this.responseText);
			}
		};

		request.send(data);
		
		//console.log();
		
		return request;
		
		/*
		$custom_request = false;
		$data = $http_header = array();
		extract($args);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);

		if ($custom_request) curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $custom_request);

		if ($data) curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

		if ($http_header) curl_setopt($ch, CURLOPT_HTTPHEADER, $http_header);
		
		$response = curl_exec($ch);
		curl_close($ch);
		
		return $response;*/
	}
	
	this.get_user = function() {
		
		var args = {
			'request_type' : 'GET',
			'url' : this.api_baseurl+"users/"+this.user_id,
			'http_header' : {
				"Content-Type" : "application/json",
				"Authorization" : "JWT "+this.access_token
			}
		};
		
		var response = this.send(args);
		
		console.log(response);
		
		//return json_decode($response);
		
	}
	
};