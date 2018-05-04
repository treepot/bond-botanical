<?php
$request_options6 = array(
	'http' => array(
		'method'  => 'GET',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"
	)
);
$context6 = stream_context_create($request_options6);

//指定したidの受注データを取得
$url6 = 'https://api.shop-pro.jp/v1/deliveries.json';

$rb6 = file_get_contents($url6, false, $context6);//response_body
$rj6 = json_decode($rb6, true);//response_json