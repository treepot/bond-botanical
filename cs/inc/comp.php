<?php
$filepath = __FILE__;
include './site.php';

session_start();

/*if($_SESSION['page_type']!=""){
	header('Location: https://bond-botanical.jp/'.$_SESSION['page_type'].'/');
}else{
	header('Location: https://bond-botanical.jp/');
};*/

$debug = '';
$debug = 1;
if($debug == 1){
header('Content-Type: text/html; charset=utf-8');
	echo '<!--<pre>';
	echo ' POST ';
	var_dump($_POST);
	echo ' SESSION ';
	var_dump($_SESSION);
	echo '</pre>-->';
}

include ROOTDIR.'inc/head.php';
include ROOTDIR.'inc/header.php';

echo '<h1>';
if($_SESSION['page_type'] == 'contact'){
	echo 'Contact';
}elseif($_SESSION['page_type'] == 'order'){
	echo 'Order';
};
echo '</h1>';

$add_header="From:".$_POST['shopAdr']."\n";//送信者の情報
$add_header .= "Reply-to:".$_POST['shopAdr']."\n";//送信者の情報
$add_header .= "X-Mailer: PHP/". phpversion();
//$opt = '-f'.$_SESSION['shopAdr'];//送信エラーの時にエラーメールを返す先  

//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
//■■ Contact ■■■■■■■■■■■■■■■■■■■■■■■■■
//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
if($_SESSION['page_type'] == 'contact'){
//管理者への送信内容
$message2 =<<<HTML
{$_SESSION['name']} 様より
【{$_SESSION['details']}】についてのお問い合わせです

■■お問い合わせ内容：
{$_SESSION['comment']}

■■お名前：
{$_SESSION['name']}

■■メールアドレス：
{$_SESSION['email']}

ー END ーーーーーーーーーーーーーーーーーーーーーーーーー

HTML;

//お客様への送信内容
$message =<<<HTML
{$_SESSION['name']} 様


この度はbois de guiにお問い合わせいただきまして、誠にありがとうございます

以下の内容でお問い合わせが送信されました
後ほどご連絡いたしますので、今しばらくお待ちください
(こちらのメールは自動返信メールです)


ーーーーーーーーーーーーーーーーーーーーーーーーーー
■■{$_SESSION['details']}

■■お名前：
{$_SESSION['name']}

■■メールアドレス：
{$_SESSION['email']}

■■お問い合わせ内容：
{$_SESSION['comment']}


────────────────────────────────
bois de gui

〒541-0041
大阪市中央区北浜2－1－16　１F

TEL 　06-6222-2287
FAX　 06-6222-2387
HTML;
  
mb_language("ja");  
mb_internal_encoding("UTF-8");
mb_convert_encoding($message,"SJIS-win","UTF-8");
/*$_SESSION['email'] ='';
echo 'test->'.mb_send_mail($_SESSION['email'], $_SESSION['name'].'様、お問い合わせありがとうございます',$message,$add_header);*/

//購入者へのメール
if(mb_send_mail($_SESSION['email'], '【bois de gui】'.$_SESSION['name'].'様、お問い合わせありがとうございます',$message,$add_header) != 0){
	echo '<p class="cname">', $_SESSION['name'],'様</p>';
	echo '<p class="thanks">お問い合わせ頂き誠にありがとうございました<br>',
			 'お問い合わせ内容を確認させていただき、<br>後ほど担当者よりご回答をさせていただきます<br>',
			 '恐れ入りますが、今しばらくお待ちください</p>';
}else{
	echo '<p class="err">大変申し訳ございません、送信が完了できませんでした<br>恐れ入りますが、';
	echo '<a href="',ROOT ,'contact/">こちらから</a>';
	echo '再度ご入力いただくか、下記へ直接ご連絡ください<br>',
			 'TEL 　06-6655-0087<br>FAX　 06-6655-0870</p>';
}

//管理者への確認用
mb_send_mail($_POST['shopAdr'],$_SESSION['name'].'様からお問い合わせがありました',$message2,$add_header);

};




//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
//■■ Order sheet ■■■■■■■■■■■■■■■■■■■■■■■
//■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
if($_SESSION['page_type'] == 'order'){

//ご依頼主(ご担当者様)のお名前
if(!empty($_SESSION['name_PIC'])){
	$name = $_SESSION['name_PIC'];
	$name_PIC_ttl = '▽[ご担当者様] お名前(ふりがな)';
	$name_PIC = $_SESSION['name_PIC'].'('.$_SESSION['furigana_PIC'].') 様';
}else{
	$name = $_SESSION['name_from'];
};
//ご担当者様の電話番号
if(!empty($_SESSION['tel_PIC'])){
	$tel_PIC_ttl = '▽[ご担当者様] 電話番号';
	$tel_PIC = $_SESSION['tel_PIC'];
}

//メッセージカード
if($_SESSION['card'] == 1){
	$card_text = $_SESSION['card_text'];
}else{
	$card_text = 'なし';
};
//立て札
if($_SESSION['notice'] == 1){
	$notice_title = $_SESSION['notice_title'];
	$notice_co_ttl_from = '[ご依頼主]';
	$notice_co_name_from = '会社(店)名：'.$_SESSION['notice_co_name_from'];
	$notice_position_from = '役職名：'.$_SESSION['notice_position_from'];
	$notice_name_from = 'お名前：'.$_SESSION['notice_name_from'];
	$notice_co_ttl_to = '[お届け先]';
	$notice_co_name_to = '会社(店)名：'.$_SESSION['notice_co_name_to'];
	$notice_position_to = '役職名：'.$_SESSION['notice_position_to'];
	$notice_name_to = 'お名前：'.$_SESSION['notice_name_to'];
}else{
	$notice_title = 'なし';
};
//より詳しいご指定など
if(!empty($_SESSION['detail_comments'])){
	$detail_comments = $_SESSION['detail_comments'];
}else{
	$detail_comments = 'なし';
}
//入金予定日
if($_SESSION['transfer'] == '銀行振込' && !empty($_SESSION['date_pay'])){
	$deposit_date_ttl = '・入金予定日';
	$deposit_date = $_SESSION['year_pay'].'年'.$_SESSION['month_pay'].'月'.$_SESSION['date_pay'].'日';
}else{
}

mb_language("ja");  
mb_internal_encoding("UTF-8");

//購入者へのメール
$message =<<<HTML
{$name} 様

ご注文ありがとうございます
Bond incです

以下の内容でオーダーシートが送信されました
後ほどご連絡いたしますので、今しばらくお待ちください
(こちらのメールは自動返信メールです)

----------------------------------------------------------------------------

■■ご注文商品■■

▽商品
{$_SESSION['flower_type']}

▽色
{$_SESSION['flower_color']}

▽用途
{$_SESSION['use']}{$_SESSION['use_other']}

▽ご予算
{$_SESSION['budget']}円(※送料・消費税を含みます)

[お支払い]
・入金方法
{$_SESSION['transfer']}

{$deposit_date_ttl}
{$deposit_date}

・お振込名
{$_SESSION['payer']}

[より詳しいご指定など]
{$detail_comments}


▽メッセージカード
{$card_text}

▽立て札
・上書き
{$notice_title}
{$notice_co_ttl_from}
{$notice_co_name_from}
{$notice_position_from}
{$notice_name_from}
{$notice_co_ttl_to}
{$notice_co_name_to}
{$notice_position_to}
{$notice_name_to}



■■お届け先■■

▽ご希望日時
{$_SESSION['year']}年{$_SESSION['month']}月{$_SESSION['date']}日 {$_SESSION['hour1']}時〜{$_SESSION['hour2']}時頃

▽お名前(ふりがな)
{$_SESSION['name_to']} ({$_SESSION['furigana_to']}) 様

▽電話番号
{$_SESSION['tel_to']}

▽郵便番号
〒{$_SESSION['zip_to']}

▽住所
{$_SESSION['pref_to']} {$_SESSION['addr_to']} {$_SESSION['room_no_to']}




■■ご依頼主■■

▽お名前(ふりがな)
{$_SESSION['name_from']} ({$_SESSION['furigana_from']}) 様

▽電話番号
{$_SESSION['tel_from']}

▽メールアドレス (※お花の写真をお送りいたします）
{$_SESSION['email']}

▽郵便番号
〒{$_SESSION['zip_from']}

▽住所
{$_SESSION['pref_from']} {$_SESSION['addr_from']} {$_SESSION['room_no_from']}

{$name_PIC_ttl}
{$name_PIC}

{$tel_PIC_ttl}
{$tel_PIC}
────────────────────────────────
bois de gui

〒541-0041
大阪市中央区北浜2－1－16　１F

TEL 　06-6222-2287
FAX　 06-6222-2387
HTML;

if(mb_send_mail($_SESSION['email'], '【bois de gui】'.$name.'様、お問い合わせありがとうございます',$message,$add_header) != 0){
	echo '<p class="cname">', $name,'様</p>';
	echo '<p class="thanks">ご注文ありがとうございます　送信完了致しました<br>',
			 'ご注文内容を確認させていただき、<br>後ほどご連絡させていただきます<br>',
			 '恐れ入りますが、今しばらくお待ちください</p>';
}else{
	echo '<p class="err">大変申し訳ございません、送信が完了できませんでした<br>恐れ入りますが、';
	echo '<a href="',ROOT ,'order_sheet/">こちらから</a>';
	echo '再度ご入力いただくか、下記へ直接ご連絡ください<br>',
			 'TEL 　06-6655-0087<br>FAX　 06-6655-0870</p>';
};

$encode_detail = '&name_to='.rawurlencode($_SESSION['name_to']);
$encode_detail .= '&furigana_to='.rawurlencode($_SESSION['furigana_to']);
$encode_detail .= '&tel_to='.rawurlencode($_SESSION['tel_to']);
$encode_detail .= '&zip_to='.rawurlencode($_SESSION['zip_to']);
$encode_detail .= '&addr_to='.rawurlencode($_SESSION['pref_to'].$_SESSION['addr_to'].$_SESSION['room_no_to']);
$encode_detail .= '&name_from='.rawurlencode($_SESSION['name_from']);
$encode_detail .= '&furigana_from='.rawurlencode($_SESSION['furigana_from']);
$encode_detail .= '&tel_from='.rawurlencode($_SESSION['tel_from']);
$encode_detail .= '&zip_from='.rawurlencode($_SESSION['zip_from']);
$encode_detail .= '&addr_from='.rawurlencode($_SESSION['pref_from'].$_SESSION['addr_from'].$_SESSION['room_no_from']);
$encode_detail .= '&email='.rawurlencode($_SESSION['email']);
$encode_detail .= '&detail_comments='.rawurlencode($_SESSION['detail_comments']);

//管理者への確認用
$message2 =<<<HTML
{$name} 様より、オーダーシートからのご注文が送信されました。

----------------------------------------------------------------------------

■■ご注文商品■■

▽商品
{$_SESSION['flower_type']}

▽色
{$_SESSION['flower_color']}

▽用途
{$_SESSION['use']}{$_SESSION['use_other']}

▽ご予算
{$_SESSION['budget']}円(※送料・消費税を含みます)

[お支払い]
・入金方法
{$_SESSION['transfer']}

{$deposit_date_ttl}
{$deposit_date}

・お振込名
{$_SESSION['payer']}

[より詳しいご指定など]
{$detail_comments}


▽メッセージカード
{$card_text}

▽立て札
・上書き
{$notice_title}
{$notice_co_ttl_from}
{$notice_co_name_from}
{$notice_position_from}
{$notice_name_from}
{$notice_co_ttl_to}
{$notice_co_name_to}
{$notice_position_to}
{$notice_name_to}



■■お届け先■■

▽ご希望日時
{$_SESSION['year']}年{$_SESSION['month']}月{$_SESSION['date']}日 {$_SESSION['hour1']}時〜{$_SESSION['hour2']}時頃

▽お名前(ふりがな)
{$_SESSION['name_to']} ({$_SESSION['furigana_to']}) 様

▽電話番号
{$_SESSION['tel_to']}

▽郵便番号
〒{$_SESSION['zip_to']}

▽住所
{$_SESSION['pref_to']} {$_SESSION['addr_to']} {$_SESSION['room_no_to']}




■■ご依頼主■■

▽お名前(ふりがな)
{$_SESSION['name_from']} ({$_SESSION['furigana_from']}) 様

▽電話番号
{$_SESSION['tel_from']}

▽メールアドレス (※お花の写真をお送りいたします）
{$_SESSION['email']}

▽郵便番号
〒{$_SESSION['zip_from']}

▽住所
{$_SESSION['pref_from']} {$_SESSION['addr_from']} {$_SESSION['room_no_from']}

{$name_PIC_ttl}
{$name_PIC}

{$tel_PIC_ttl}
{$tel_PIC}

ー END ーーーーーーーーーーーーーーーーーーーーーーーーー

▽注文書・受領書：
https://bond-botanical.jp/pdf/?id=0&format=1{$encode_detail}

▽納品書：
https://bond-botanical.jp/pdf/?id=0&format=2{$encode_detail}
HTML;

mb_send_mail($_POST['shopAdr'],$name.'様からご注文です',$message2,$add_header);

};



session_destroy();  // セッションを破棄

include ROOTDIR.'inc/footer.php';