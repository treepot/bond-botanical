<?php
include './site.php';

$add_header="From:".$shopAdr."\n";//送信者の情報
$add_header .= "Reply-to:".$shopAdr."\n";//送信者の情報
$add_header .= "X-Mailer: PHP/". phpversion();

echo '<!doctype html><html><head><meta charset="UTF-8"><title>bois de gui | error</title></head><body>';

mb_language("ja");  
mb_internal_encoding("UTF-8");

if(mb_send_mail('tsuji@ficus.win', 'bois de gui error log',$_POST['errlog'],$add_header) != 0){
	echo '<p>送信完了</p>';
}else{
	echo '<p>送信できませんでした<br>恐れ入りますが、開発者へ直接ご連絡ください<br>',
			 '【Ficus】tsuji@ficus.win</p>';
};

echo '<a href="'.ROOT.'">サイトへ戻る</a></body></html>';