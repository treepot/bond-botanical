<?php
include 'site.php';
$attributes7 = array("restock" => true);

$request_options7 = array(
	'http' => array(
		'method'  => 'PUT',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"."Content-Type: application/json\r\n",
		'content' => json_encode($attributes7)
	)
);
$context7 = stream_context_create($request_options7);

$url7 = 'https://api.shop-pro.jp/v1/sales/'.$_POST['thisid'].'/cancel.json';

$rb7 = file_get_contents($url7, false, $context7);//response_body
$rj7 = json_decode($rb7, true);//response_json

header('Location: '.ROOT.'admin/detail.php?id='.$_POST['thisid']);
exit;