<?php
include './site.php';

session_start();
if($_SESSION['name']==""){
	//echo 'err';
	header('Location: http://bond-botanical.jp/cs/contact/');//	headerlocationはPHPのリダイレクト処理でよく使う。
}

include ROOTDIR.'inc/head.php';
include ROOTDIR.'inc/header.php';

$add_header="From:tsuji@ficus.win\n";//送信者の情報(メールヘッダー)
$add_header	.= "Reply-to: tsuji@ficus.win\n";//送信者の情報(メールヘッダー)
$add_header	.= "X-Mailer: PHP/". phpversion();
$opt = '-f'.'tsuji@ficus.win'; //-fすると迷惑メールになりにくいとか、そんなことだったと思う。送信エラーの時にエラーメールを返す先

$message =<<<HTML
お問い合わせ内容の確認です。
お問い合わせ内容：
{$_SESSION['details']}
お名前：
{$_SESSION['name']}
メールアドレス：
{$_SESSION['email']}
お問い合わせ内容：
{$_SESSION['comment']}
内容確認後、担当者より折り返しご連絡をさせて頂きます。
今しばらくお待ちください。
HTML;

mb_language("ja");// カレントの言語を日本語に設定
mb_internal_encoding("UTF-8");// 内部文字エンコードを設定
mb_send_mail($_SESSION['email'],"【お問い合わせ】確認メール",$message,$add_header);
//mb_send_mailは5つの設定項目がある
//mb_send_mail(送信先メールアドレス,"メールのタイトル","メール本文","メールのヘッダーFromとかリプライとか","送信エラーになったらどこにメール返すんじゃいっ！");
//5番目の情報は第5引数と呼ばれるものでして、これがないと迷惑メール扱いになることも。
//マスター管理者にもお問い合わせがあったことを知らせる
mb_send_mail('tsuji@ficus.win','問い合わせがありました', $message, $add_header);
echo $_SESSION['name'],'様<br>お問い合わせいただきありがとうございました。';
session_destroy();  // セッションを破棄

include ROOTDIR.'inc/footer.php';