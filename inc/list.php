<?php
include 'site.php';
$request_options = array(
	'http' => array(
		'method'  => 'GET',
		'header'=> "Authorization: Bearer ".$access_token."\r\n"
	)
);
$context = stream_context_create($request_options);

//受注データのリストを取得（日時が指定されていない場合は直近1週間分を取得）
$url = 'https://api.shop-pro.jp/v1/sales.json?limit=50';
$search = '';
if(!empty($_GET[ids])):
	$search .= '&ids='.$_GET[ids];
endif;
if(!empty($_GET[after])):
	$search .= '&after='.$_GET[after];
else:
	$search .= '&after='.$after_s;
endif;
if(!empty($_GET[before])):
	$search .= '&before='.$_GET[before];
endif;
if(isset($_GET[accepted_mail_state]) && $_GET[accepted_mail_state] != 'all'):
	$search .= '&accepted_mail_state='.$_GET[accepted_mail_state];
endif;
if(isset($_GET[paid_mail_state]) && $_GET[paid_mail_state] != 'all'):
	$search .= '&paid_mail_state='.$_GET[paid_mail_state];
endif;
if(isset($_GET[delivered_mail_state]) && $_GET[delivered_mail_state] != 'all'):
	$search .= '&delivered_mail_state='.$_GET[delivered_mail_state];
endif;
$url = $url.$search;

$rb = file_get_contents($url, false, $context);//response_body
$rj = json_decode($rb, true);//response_json
