<?php
//session_start();
/*$_SESSION = $_POST;
if(!isset($_SESSION['clientAdr']) || !isset($_SESSION['shopAdr']) || !isset($_SESSION['mailBody'])):
	$_SESSION['send'] = "notsend";
	header('Location: ../admin/', TRUE, 307);
	exit;
endif;//送信先、送信元アドレス、本文がない場合はリダイレクト

$add_header="From:".$_SESSION['shopAdr']."\n";//送信者の情報
$add_header .= "Reply-to:".$_SESSION['shopAdr']."\n";//送信者の情報
$add_header .= "X-Mailer: PHP/". phpversion();
$opt = '-f'.$_SESSION['shopAdr'];//送信エラーの時にエラーメールを返す先  

$message =<<<HTML
{$_SESSION['mailBody']}
HTML;

$message2 =<<<HTML
以下の内容で {$_SESSION['c_name']}様にメールが送信されました

[件名]
{$_SESSION['mailSub']}

[本文]
{$_SESSION['mailBody']}

ID:{$_SESSION['thisid']}
HTML;
  
mb_language("ja");  
mb_internal_encoding("UTF-8");*/

//購入者へのメール
//mb_send_mail($_SESSION['clientAdr'], $_SESSION['mailSub'],$message,$add_header,$opt);//mail.phpで同内容のメール送信が発生するためコメントアウト

//管理者への確認用
//mb_send_mail($_SESSION['shopAdr'],"[bois de guiショップ]メールを送信しました",$message2,$add_header,$opt);

//送信済みに変更
include_once('mail.php');

//入金・発送済みに変更
if($_SESSION['mail_type'] == 2 || $_SESSION['mail_type'] == 3):
	include_once('salesid.php');
endif;

//session_destroy();//セッションを破棄

header('Location: ../admin/', TRUE, 307);
exit();

//http://www.kaasan.info/archives/2151