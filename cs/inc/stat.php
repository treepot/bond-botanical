<?php
include 'site.php';
$request_options7 = array(
	'http' => array(
		'method'  => 'GET',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"
	)
);
$context7 = stream_context_create($request_options7);

//指定したidの受注データを取得
$url7 = 'https://api.shop-pro.jp/v1/sales/stat.json?make_date='.$date;

$rb7 = file_get_contents($url7, false, $context7);//response_body
$rj7 = json_decode($rb7, true);//response_json