<?php
include('site.php');

$request_options8 = array(
	'http' => array(
		'method'  => 'GET',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"
	)
);
$context8 = stream_context_create($request_options8);

//指定したidの受注データを取得
$url8 = 'https://api.shop-pro.jp/v1/deliveries/date.json';

$rb8 = file_get_contents($url8, false, $context8);//response_body
$rj8 = json_decode($rb8, true);//response_json

echo '<pre>';
var_dump($rj8);
echo '</pre>';