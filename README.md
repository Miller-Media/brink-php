<img src="http://joinbrink.com/assets/images/repo/Brink.png" style="display:block;margin:0 auto;max-width:100px;">
<br />
<img src="http://joinbrink.com/assets/images/repo/PHP-logo.png" style="display:block;margin:0 auto;max-width:100px;">

Install the PHP Package
-------------------------

```
    $ composer require millermedia/brink-php
```

Using the API
--------------

1. Login to the api to receive a jwt token that can be used in future requests without the need to reauthenticate

```php
	include("vendor/autoload.php");
	$brink_api = new \MillerMedia\Brink\Brink_API();

	// Login to the api via username and password
	$user_data = array(
		"username" => 'username',
		"password" => 'password'
	);
	$response = $brink_api->login($user_data);

	if (isset($response->error)) {
		// Login Error
		echo $response->error;
		exit;
	}
	$access_token = $response->jwt_token;

	// After logging in using the $brink_api->login() method, the token is already set
	// so additional requests can be handled correctly
	$flights = $brink_api->get_all_flights();
```

2. If you already have a jwt token prepared, you can use it when creating the api instance and bypass logging in.

```php
	include("Brink_API.php");
	$brink_api = new Brink_API();

	$token='eyJ0eXAiOiJKV1QiLCJhbGc...';
	$brink_api->access_token = $token;

	// Get all flights
	$flights = $brink_api->get_all_flights();

	// Get details for a specific flights
	$params = array('flight_id' => 12);
	$flight = $brink_api->get_flight($params);

	// Get data points for a specific flight
	$params = array('flight_id'=>15, 'prop' => array('page'=>1, 'per_page'=>5));
	$flight_data = $brink_api->get_flight_data($params);
```