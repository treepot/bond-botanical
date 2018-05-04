<?php
include '../inc/site.php';
include_once ROOTDIR.'inc/sales.php';
include_once ROOTDIR.'inc/deliveries.php';
include_once ROOTDIR.'inc/payments.php';
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<!--<meta name="viewport" content="width=device-width,initial-scale=1.0">-->
<meta name="format-detection" content="telephone=no" />
<title>bois de gui | 売上詳細</title>
<link rel="stylesheet" href="<?php print ROOT ?>css/common.css">
<link rel="stylesheet" href="<?php print ROOT ?>css/admin.css">
<link rel="stylesheet" href="<?php print ROOT ?>css/themify-icons.css"><!-- https://themify.me/themify-icons -->
<script src="<?php print ROOT ?>js/jquery.min.js"></script>
<script src="<?php print ROOT ?>js/jquery.cleanQuery.js"></script>
<script src="<?php print ROOT ?>js/admin.js"></script>
</head>

<?php
$page = $_GET[page];
$after = $_GET[after];
$before = $_GET[before];
$ams = $_GET[accepted_mail_state];
$pms = $_GET[paid_mail_state];
$dms = $_GET[delivered_mail_state];
$skeep = '';
if(isset($page)){$skeep.='&page='.$page;}
if(isset($after)){$skeep.='&after='.$after;}
if(isset($before)){$skeep.='&before='.$before;}
if(isset($ams)){$skeep.='&accepted_mail_state='.$ams;}
if(isset($pms)){$skeep.='&paid_mail_state='.$pms;}
if(isset($dms)){$skeep.='&delivered_mail_state='.$dms;}

?>
<body>
	<header>
  	<?php include_once ROOTDIR.'admin/admin_header.php' ?>
  </header>
  <section class="pdf">
  	<a href="<?php echo ROOT.'pdf/?id='.$_GET['id'].'&format=3' ?>" target="_blank"><span class="ti-import"></span>PDF Download (注文書・受領書・納品書)</a>
  	<!--<a href="<?php echo ROOT.'pdf/?id='.$_GET['id'].'&format=1' ?>" target="_blank"><span class="ti-import"></span>PDF Download (注文書・受領書)</a>
  	<a href="<?php echo ROOT.'pdf/?id='.$_GET['id'].'&format=2' ?>" target="_blank"><span class="ti-import"></span>PDF Download (納品書)</a>-->
  </section>
	<section class="detailArea">
    <?php
		echo '<!--<pre>';
		var_dump($rj1);
		//var_dump($rj8);
		echo '</pre>-->';
    /*---------------------
		　表タイトル部分
		---------------------*/
		echo '<h2><span class="ti-id-badge"></span>注文情報(購入者情報)</h2>';
		echo '<table>';
		
		echo '<tr><th>売上ID</th><td>'.$rj1['sale']['id'].'</td></tr>';
		echo '<tr><th>受注日</th><td>'.date('Y/m/d H:i',$rj1['sale']['make_date']).'</td></tr>';
		echo '<tr><th>決済方法</th><td>';
		if($rj1['sale']['payment_id'] == 758255){
			echo '銀行振込';
		}elseif($rj1['sale']['payment_id'] == 761257){
			echo 'PayPal';
		}else{
			echo 'その他';
		}
		echo'</td></tr>';
		echo '<tr><th>状態</th><td>';
		if($rj1['sale']['canceled']){
			echo 'キャンセル';
		}elseif($rj1['sale']['delivered']){
			echo '発送済';
		}elseif($rj1['sale']['paid']){
			echo '入金済';
		}elseif($rj1['sale']['accepted_mail_state'] == 'sent'){
			echo '受付済';
		}elseif($rj1['sale']['accepted_mail_state'] == 'not_yet'){
			echo '未受付';
		};
		echo '</td></tr>';
		echo '<tr><th>名前</th><td>'.$rj1['sale']['customer']['name'];// required
		if(!empty($rj1['sale']['customer']['furigana'])){
			echo '('.$rj1['sale']['customer']['furigana'].')';
		};
		echo '</td></tr>';
		if(!empty($rj1['sale']['customer']['hojin'])){
			echo '<tr><th>法人名</th><td>'.$rj1['sale']['customer']['hojin'].'</td></tr>';
		};
		if(!empty($rj1['sale']['customer']['busho'])){
			echo '<tr><th>部署名</th><td>'.$rj1['sale']['customer']['busho'].'</td></tr>';
		};
		if(!empty($rj1['sale']['customer']['postal'])){
			echo '<tr><th>郵便番号</th><td>'.$rj1['sale']['customer']['postal'].'</td></tr>';
		};
		echo '<tr><th>住所</th><td>'.$rj1['sale']['customer']['pref_name'].$rj1['sale']['customer']['address1'].$rj1['sale']['customer']['address2'].'</td></tr>';// required
		echo '<tr><th>メールアドレス</th><td>'.$rj1['sale']['customer']['mail'].'</td></tr>';// required
		echo '<tr><th>電話番号</th><td>'.$rj1['sale']['customer']['tel'].'</td></tr>';// required
		if(!empty($rj1['sale']['customer']['fax'])){
			echo '<tr><th>FAX番号</th><td>'.$rj1['sale']['customer']['fax'].'</td></tr>';
		};
		if(!empty($rj1['sale']['customer']['tel_mobile'])){
			echo '<tr><th>携帯電話番号</th><td>'.$rj1['sale']['customer']['tel_mobile'].'</td></tr>';
		};
		echo '<tr><th>ユーザー登録</th><td>';
		if($rj1['sale']['customer']['member']){
			echo '有';
		}else{
			echo '無';
		};
		echo '</td></tr>';
		if(!empty($rj1['sale']['customer']['memo'])){
			echo '<tr><th>備考</th><td>'.$rj1['sale']['customer']['memo'].'</td></tr>';
		};
		echo '</table>';
		
		echo '<h2><span class="ti-map-alt"></span>お届け先・商品詳細情報</h2>';
		echo '<table>';
		echo '<tr><th>名前</th><td>'.$rj1['sale']['sale_deliveries'][0]['name'];
		if(!empty($rj1['sale']['sale_deliveries'][0]['furigana'])):
			echo '('.$rj1['sale']['sale_deliveries'][0]['furigana'].')';
		endif;
		echo '</td></tr>';
		if(!empty($rj1['sale']['sale_deliveries'][0]['postal'])):
			echo '<tr><th>郵便番号</th><td>'.$rj1['sale']['sale_deliveries'][0]['postal'].'</td></tr>';
		endif;
		echo '<tr><th>住所</th><td>'.$rj1['sale']['sale_deliveries'][0]['pref_name'].$rj1['sale']['sale_deliveries'][0]['address1'].$rj1['sale']['sale_deliveries'][0]['address2'].'</td></tr>';
		echo '<tr><th>電話番号</th><td>'.$rj1['sale']['sale_deliveries'][0]['tel'].'</td></tr>';
		echo '<tr><th>備考</th><td>'.$rj1['sale']['sale_deliveries'][0]['memo'].'</td></tr>';
		echo '<tr><th>配送伝票番号</th><td>';
		echo '<form action="../inc/salesid.php" method="post" id="slip_number"><input placeholder="未設定" type="text" name="slip"';
		if(!empty($rj1['sale']['sale_deliveries'][0]['slip_number'])){
			echo 'value="'.$rj1['sale']['sale_deliveries'][0]['slip_number'].'"';
		}else{
			echo ' class="empty"';
		};
		echo '><input type="hidden" name="thisid" value="'.$_GET['id'].'"><input type="hidden" name="sale_deliveries_id" value="'.$rj1['sale']['sale_deliveries'][0]['id'].'"><button type="submit" name="from" value="detail">SAVE</button></form>';
		echo '</td></tr>';
		echo '<tr><th>発送状態</th><td>';
		if($rj1['sale']['canceled']){
			echo 'キャンセル';
		}elseif($rj1['sale']['delivered']){
			echo '発送済み';
		}else{
			echo '未発送';
		};
		echo '</td></tr>';
		echo '<tr><th>お届け希望日</th><td>';
		$deli_date = $rj1['sale']['sale_deliveries'][0]['preferred_date'];
		if(!empty($deli_date)){
			echo date('Y/n/j', strtotime($rj1['sale']['sale_deliveries'][0]['preferred_date'])).'('.$w[date('w', strtotime($rj1['sale']['sale_deliveries'][0]['preferred_date']))].')';
		}else{
			echo '指定なし';}
		echo '</td></tr>';
		echo '<tr><th>お届け希望時間帯</th><td>';
		if(!empty($rj1['sale']['sale_deliveries'][0]['preferred_period'])){
			echo $rj1['sale']['sale_deliveries'][0]['preferred_period'];
		}else{
			echo '指定なし';}
		echo '</td></tr>';
		echo '<tr><th>配送会社</th><td>'.$rj6["deliveries"][0]["name"].'</td></tr>';
		echo '<tr><td colspan="2" class="p0">';
		echo '<table class="products"><tr><th>商品ID</th><th>型番</th><th>商品名</th><th>価格(税込)</th><th>数量</th><th>小計</th></tr>';
		$i=0;
		while(!empty($rj1['sale']['details'][$i])){
			echo '<tr><td>'.$rj1['sale']['details'][$i]['product_id'].'</td><td>'.$rj1['sale']['details'][$i]['product_model_number'].'</td><td><img src="'.$rj1['sale']['details'][$i]['product_thumbnail_image_url'].'">'.$rj1['sale']['details'][$i]['product_name'];
			if(isset($rj1['sale']['details'][$i]['option1_value'])):
				echo ' '.$rj1['sale']['details'][$i]['option1_value'];
			endif;
			if(isset($rj1['sale']['details'][$i]['option2_value'])):
				echo ' '.$rj1['sale']['details'][$i]['option2_value'].'<br>';
			endif;
			echo '</td><td>'.number_format($rj1['sale']['details'][$i]['price_with_tax']).'円</td><td>'.$rj1['sale']['details'][$i]['product_num'].$rj1['sale']['details'][$i]['unit'].'</td><td>'.number_format($rj1['sale']['details'][$i]['subtotal_price']).'円</td></tr>';
			$i++;
		};
		echo '</table></td></tr>';
		echo '<tr><th>送料</th><td>'.number_format($rj1['sale']['delivery_total_charge']).'円</td></tr>';
		echo '<tr><th>配送先合計</th><td>'.number_format($rj1['sale']['product_total_price']).'円</td></tr>';
		echo '</table>';

		echo '<h2><span class="ti-money"></span>商品総合計情報</h2><table>';
		echo '<tr><th>商品合計(消費税)</th><td>'.number_format($rj1['sale']['product_total_price']).'円('.number_format($rj1['sale']['tax']).'円)</td></tr>';
		echo '<tr><th>送料合計(税込)</th><td>'.number_format($rj1['sale']['delivery_total_charge']).'円</td></tr>';
		echo '<tr><th>決済手数料(税込)</th><td>'.number_format($rj1['sale']['fee']).'円</td></tr>';
		echo '<tr><th>総合計</th><td>'.number_format($rj1['sale']['total_price']).'円</td></tr>';
		echo '</table>';
    if(!$rj1['sale']['canceled'] && !$rj1['sale']['delivered']):
    echo '<div class="order_cancel">オーダーキャンセル</div><div class="cancelBg" style="display:none;"></div>';
    echo '<form action="../inc/cancel.php" method="post" id="cancelBtn" style="display:none;"><p><span class="ti-alert"></span>このご注文をキャンセルしてもよろしいですか？</p><button type="submit" name="thisid" value="'.$_GET['id'].'">はい</button><div class="no">いいえ</div></form>';
		endif;
		?>
  </section>
  <footer>
  	<a href="http://admin.shop-pro.jp" target="_blank">カラーミーショップ管理画面</a>
  </footer>
</body>
</html>