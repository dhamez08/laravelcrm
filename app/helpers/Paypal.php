<?php
namespace helpers;
/**
*
*
**/
class Paypal {

	public static function request($method, $requestParams) {

		// the paypal endpoint
		//$paypal_url = "https://api-3t.sandbox.paypal.com/nvp";
		$paypal_url = "https://api-3t.paypal.com/nvp";

		$parms = array(
			'USER' => 'steve.warden_api1.123-insureme.co.uk',
			'PWD' => '9H8LC2GW97LB8MD6',
			'SIGNATURE' => 'An5ns1Kso7MWUdW4ErQKJJJ4qi4-AtTZdUQHqgcSI1dFjsSryxxe38Nj',
			'METHOD' => $method,
			'VERSION' => '98.0',
			'CARTBORDERCOLOR' => 'DE4681',
			'BRANDNAME' => 'One23 CRM'
		);

		$request = http_build_query($parms+$requestParams);

		$curlOptions = array (
			CURLOPT_URL => $paypal_url,
			CURLOPT_VERBOSE => 1,
			CURLOPT_SSL_VERIFYPEER => FALSE,
			CURLOPT_SSL_VERIFYHOST => FALSE,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $request
		);

		$ch = curl_init();
		curl_setopt_array($ch,$curlOptions);
		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			// sort out errors
			return false;
		} else {
			curl_close($ch);
			$responseArray = array();
			parse_str($response,$responseArray); // break into an array
			return $responseArray;
		}
	}
}
