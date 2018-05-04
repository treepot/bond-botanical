<?php
include_once 'site.php';
/*
mail_type=0：受注時自動送信メール
mail_type=1：受注確認メール
mail_type=2：入金確認メール
mail_type=3：発送メール
*/

/*フォームからの引数*/
$mail_type = $_POST['mail_type'];
$cnt = $_POST['cnt'];


//入金・発送済みに変更
if($mail_type == 2 || $mail_type == 3){
	require_once('salesid.php');
}
if($_POST['not_mail'] != 1){
	/*-------------------------------------------*/
	if($mail_type == 1){
		$attributes4 = array("mail" =>
				array("type" => "accepted")
		);
	}elseif($mail_type == 2){
		$attributes4 = array("mail" =>
				array("type" => "paid")
		);
	}elseif($mail_type == 3){
		$attributes4 = array("mail" =>
				array("type" => "delivered")
		);
	};
	
	$request_options4 = array(
		'http' => array(
			'method'  => 'POST',
			'header'=> "Authorization: Bearer ".$access_token."\r\n"."Content-Type: application/json\r\n",
			'content' => json_encode($attributes4),
			'ignore_errors' => true
		)
	);
	$context4 = stream_context_create($request_options4);
	$url4 = 'https://api.shop-pro.jp/v1/sales/'.$_POST['thisid'].'/mails.json';
	
	$rb4 = file_get_contents($url4, false, $context4);//response_body
	$rj4 = json_decode($rb4, true);//response_json
	/*-------------------------------------------*/
	
	$now = time();
	$send = $_POST['send'];
	$send = '';
	/* メール送信時の送信日時と現在時刻を比較して最新情報を判定 */
	require_once('list.php');
	if($mail_type == 1):
		$date_a = $rj['sales'][$cnt]['accepted_mail_sent_date'];
		if(!isset($date_a)){
			$send = 2;
		}elseif($date_a < $now+10 && $date_a > $now-10){
			$send = 1;
		}else{
			$send = 2;
		};
	elseif($mail_type == 2):
		$date_a = $rj['sales'][$cnt]['paid_mail_sent_date'];
		if(!isset($date_a)){
			$send = 2;
		}elseif($date_a < $now+10 && $date_a > $now-10){
			$send = 1;
		}else{
			$send = 2;
		};
	elseif($mail_type == 3):
		$date_a = $rj['sales'][$cnt]['delivered_mail_sent_date'];
		if(!isset($date_a)){
			$send = 2;
		}elseif($date_a < $now+10 && $date_a > $now-10){
			$send = 1;
		}else{
			$send = 2;
		};
	endif;
};


//処理後のリダイレクト先

$page = $_GET[page];
/*$after = $_GET[after];
$before = $_GET[before];
$ams = $_GET[accepted_mail_state];
$pms = $_GET[paid_mail_state];
$dms = $_GET[delivered_mail_state];*/
$skeep = '';
if(isset($page)){$skeep.='&page='.$page;}
/*if(isset($after)){$skeep.='&after='.$after;}
if(isset($before)){$skeep.='&before='.$before;}
if(isset($ams)){$skeep.='&accepted_mail_state='.$ams;}
if(isset($pms)){$skeep.='&paid_mail_state='.$pms;}
if(isset($dms)){$skeep.='&delivered_mail_state='.$dms;}*/

//header('Location: ../admin/', TRUE, 307);

header('Location: ../admin/?send='.$send.$skeep.$search);
exit();