<?php
$request_options3 = array(
	'http' => array(
		'method'  => 'GET',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"
	)
);
$context3 = stream_context_create($request_options3);

//指定したidの受注データを取得
$url3 = 'https://api.shop-pro.jp/v1/shop.json';

$rb3 = file_get_contents($url3, false, $context3);//response_body
$rj3 = json_decode($rb3, true);//response_json