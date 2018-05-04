<?php
include_once 'site.php';

if($_POST['mail_type'] == 2):
	$attributes5 = array("sale" =>
			array("paid" => true)
	);
elseif($_POST['mail_type'] == 3):
	$attributes5 = array("sale" =>
		array("sale_deliveries" =>
			array(
				array(
					"id" => $_POST['sale_deliveries_id'],
					"delivered" => true
				)
			)
		)
	);
endif;


if(isset($_POST['slip'])):
	$attributes5 = array("sale" =>
		array("sale_deliveries" =>
			array(
				array(
					"id" => $_POST['sale_deliveries_id'],
					"slip_number" => $_POST['slip']
				)
			)
		)
	);
endif;

$request_options5 = array(
	'http' => array(
		'method'  => 'PUT',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"."Content-Type: application/json\r\n",
		'content' => json_encode($attributes5)
	)
);
$context5 = stream_context_create($request_options5);

$url5 = 'https://api.shop-pro.jp/v1/sales/'.$_POST['thisid'].'.json';

$rb5 = file_get_contents($url5, false, $context5);//response_body
$rj5 = json_decode($rb5, true);//response_json

if($_POST['from'] == 'detail'){
	header('Location: ../admin/detail.php?id='.$_POST['thisid']);
	exit();
};