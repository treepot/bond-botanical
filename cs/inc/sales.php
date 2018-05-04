<?php
$request_options1 = array(
	'http' => array(
		'method'  => 'GET',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"
	)
);
$context1 = stream_context_create($request_options1);

//指定したidの受注データを取得
$url1 = 'https://api.shop-pro.jp/v1/sales/'.$_GET['id'].'.json';

$rb1 = file_get_contents($url1, false, $context1);//response_body
$rj1 = json_decode($rb1, true);//response_json