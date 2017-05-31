<?php

define( 'API_BASE', 'http://www.politifact.com/api/v/2' );

session_start();

$endpoint = $_REQUEST['_ep'];
header('Content-Type: application/json');

if (!empty($endpoint)) {
	$args = http_build_query(array_merge($_REQUEST, array('format' => 'json')));
	echo send_request(API_BASE . $endpoint . '?' . $args);
} else {
	error('No endpoint requested');
}

function error($message) {
	http_response_code(400);
	echo json_encode(array('error' => $message));
	die;
}

function send_request($url) {
	if (function_exists('curl_init')) {
		$curl = curl_init($url);

		curl_setopt_array( $curl, array(
			CURLOPT_URL            => $url,
			CURLOPT_RETURNTRANSFER => true,  // Capture response.
			CURLOPT_ENCODING       => "",  // Accept gzip/deflate/whatever.
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 30,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => "GET",
		) );

		$response = curl_exec($curl);
		if ($response === false) {
			$response = curl_getinfo( $curl );
		}
		curl_close($curl);

		return $response;
	} else {
		return file_get_contents($url);
	}
}
