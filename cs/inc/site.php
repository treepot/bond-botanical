<?php
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
define('ROOTDIR', '/home/users/0/lolipop.jp-2684e7861272dde5/web/');//フルパス
define('ROOT', 'https://bond-botanical.jp/');//絶対パス

//トップページスライダーの画像を指定
$mv = array("top_img6.jpg","top_img4.jpg","top_img5.jpg","top_img9.jpg","top_img13.jpg","top_img14.jpg");

//ショップ情報
$shop_url = 'https://bois-de-gui.shop-pro.jp/';
$shopAdr = 'tsuji@ficus.win';//'info@bond-botanical.jp';
//商品ID
$product_id = array(
								121563050,// Arrangement (ラウンドタイプ)
								121565779,//Arrangement (ロングタイプ)
								121566337,// Bouquet (ラウンドタイプ)
								121567981,//Bouquet (ロングタイプ)
								122948001//Bouquet決済テスト用
							);

//カラーミーAPI
$access_token = '408a69344cffab094f887b307827cbd9b40247102ff9a28c16964b98793e5f20';

//日付を取得
$now = time();

//カラー
$color_val = array('white_green','yellow_orange','purple','pink','red','antique','count_on');

//曜日
$w = array('日','月','火','水','木','金','土');