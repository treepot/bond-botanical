<?php

//デバッグ
$debug = 0;
if(isset($_GET['mode'])){
  if($_GET['mode'] == 'debug'){
    $debug = 1;
  }
}
//PHPエラー表示設定
if($debug == 1){
  error_reporting(E_ALL);
}else{
  error_reporting(0);
}

$title = array('Top',"What's new",'Order','Wedding','Works','Lesson','Shop','Contact','check','comp', 'Order Sheet', 'Not Found');
$ttl_str = array(' ', "'");
$file_str = array('_', '');
//$dirs = $title;//各ページのタイトル=ディレクトリ名
$logo_pc = 'bois-de-gui-logo_white.png';//logo画像
$logo_sp = 'bois-de-gui-logo.png';
$logo_alt = 'bois de gui ~ボワドゥギ~';//logoの説明

//現在のページを判定
for($n=1; $n < count($title); $n++){
	$filename = str_replace($ttl_str, $file_str, mb_strtolower($title[$n]));
	if (strpos($filepath, $filename) !== false){ $page = $n; };
};
if(empty($page)){$page = 0;};

$page_dir = str_replace($ttl_str, $file_str, mb_strtolower($title[$page]));

//ルートディレクトリを定義
//define('ROOTDIR', '/home/users/0/lolipop.jp-2684e7861272dde5/web/');
define('ROOTDIR', '/home/users/0/noor.jp-five/web/bois_de_gui/');//フルパス
//define('ROOT', 'https://bond-botanical.jp/');
define('ROOT', 'https://ficus.win/bois_de_gui/');//絶対パス

//トップページスライダーの画像を指定
$mv = array("top_img6.jpg","top_img4.jpg","top_img5.jpg","top_img9.jpg","top_img13.jpg","top_img14.jpg");

//ショップ情報
$shop_url = 'https://bois-de-gui.shop-pro.jp/';
$shopAdr = 'info@bond-botanical.jp';
//商品ID
$product_id = array(
								121563050,// Arrangement (ラウンドタイプ)0
								121565779,//Arrangement (ロングタイプ)1
								121566337,// Bouquet (ラウンドタイプ)2
								121567981,//Bouquet (ロングタイプ)3
								122948001,//Bouquet決済テスト用4
								130140115,//母の日用 Arrangement (ラウンドタイプ)5
								130169233//母の日用 Bouquet6
							);

//カラーミーAPI
$access_token = '408a69344cffab094f887b307827cbd9b40247102ff9a28c16964b98793e5f20';

//日付を取得
$now = time();
$now_date = date('YmdHi');

//カラー
$color_val = array('white_green','yellow_orange','purple','pink','red','antique','count_on');

//曜日
$w = array('日','月','火','水','木','金','土');


//母の日表示設定
$season_open = 0;//注文受付フラグ
$season_display = 0;//表示フラグ
$promo_start = strtotime('201804090000');
$promo_end = strtotime('201805082359');
$promo_display_end = strtotime('201805132359');

if(isset($_GET['now'])){
	$promo_now = strtotime($_GET['now']);
}else{
	$promo_now = strtotime($now_date);
}
if($promo_now >= $promo_start && $promo_now <= $promo_end){
  $season_open = 1;
}
if($promo_now >= $promo_start && $promo_now <= $promo_display_end){
  $season_display = 1;
}
