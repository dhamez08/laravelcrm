<?php
namespace helpers;
/**
 * TinyURL API Wrapper Class
 *
 */
class TinyURL {
	const REQUEST_URL = 'http://tiny-url.info/api/v1/create';
	const TINY_FORMAT = 'json';
	const TINY_API_KEY = '28DA8C94DE7830AB67DD';
	const TINY_PROVIDER = 'p_tl';

	public static function tinyurl($url){
		$lurl = $url;

		$curl = curl_init();
		$post_data = array('format' => self::TINY_FORMAT,
						   'apikey' => self::TINY_API_KEY,
						   'provider' => self::TINY_PROVIDER,
						   'url' => $lurl );
		$api_url = 'http://tiny-url.info/api/v1/create';
		curl_setopt($curl, CURLOPT_URL, $api_url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_POST, 1);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
		$result = curl_exec($curl);
		curl_close($curl);

		return json_decode($result);
	}
}



