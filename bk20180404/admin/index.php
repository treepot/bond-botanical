<?php
include '../inc/site.php';
//include_once ROOTDIR.'inc/sales.php';//1
include_once ROOTDIR.'inc/shop.php';//3
//include_once ROOTDIR.'inc/mail.php';//4
//include_once ROOTDIR.'inc/salesid.php';//5
include_once ROOTDIR.'inc/deliveries.php';//6
//include_once ROOTDIR.'inc/stat.php';//7
?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<!--<meta name="viewport" content="width=device-width,initial-scale=1.0">-->
<meta name="format-detection" content="telephone=no" />
<title>bois de gui | 受注管理</title>
<link rel="stylesheet" href="<?php echo ROOT ?>css/common.css">
<link rel="stylesheet" href="<?php echo ROOT ?>css/admin.css">
<link rel="stylesheet" href="<?php echo ROOT ?>css/themify-icons.css"><!-- https://themify.me/themify-icons -->
<script src="<?php echo ROOT ?>js/jquery.min.js"></script>
<script src="<?php echo ROOT ?>js/jquery.cleanQuery.js"></script>
<script src="<?php echo ROOT ?>js/admin.js"></script>
</head>

<?php
$after_s = '2017-07-14';//開始期間の初期値。指定がなければ1週間分しか表示されないため設定
$ids = $_GET[ids];
$after = $_GET[after];
$before = $_GET[before];
$ams = $_GET[accepted_mail_state];
$pms = $_GET[paid_mail_state];
$dms = $_GET[delivered_mail_state];
$send = $_GET[send];
include_once ROOTDIR.'inc/list.php';

/*--- 静的情報 -----*/
$user_mail = $rj3['shop']['user_mail'];//ショップメールアドレス
?>
<body>
	<header>
  	<?php include_once ROOTDIR.'admin/admin_header.php' ?>
  </header>
	<?php
    if($send == 1){
      echo '<div class="send ti-email">メールを送信しました</div>';
		}elseif($send == 2){
      echo '<div class="send ti-email">メール送信に失敗しました</div>';
		};
  ?>
	<section class="form">
    <form action="/admin/" method="get" id="form">
      <table>
        <tr>
          <th>受注番号：</th>
          <td><input type="text" name="ids" class="ids" placeholder="受注番号を入力してください (カンマ区切り可)" <?php if(!empty($ids)){echo 'value="'.$ids.'"';}; ?>></td>
        </tr>
        <tr>
          <th>期間：</th>
          <td>
          	<input type="text" name="after" class="after" placeholder="<?php echo $after_s ?>" <?php if(!empty($after)){echo 'value="'.$after.'"';}else{echo 'value="'.$after_s.'"';}; ?>>〜<!--
         --><input type="text" name="before" class="before" placeholder="2017-01-01" <?php if(!empty($before)){echo 'value="'.$before.'"';}; ?>>
          </td>
        </tr>
        <tr>
          <th>受注メール送信状態：</th>
          <td class="ams">
          	<div class="amsSlctd slctd"></div>
            <div class="option">
              <input type="radio" name="accepted_mail_state" value="all" id="amsAll" <?php if($ams == 'all' || !isset($ams)){echo 'checked';}; ?>>
              <label for="amsAll">全て</label>
              <input type="radio" name="accepted_mail_state" value="0" id="ams0" <?php if($ams == 0 && $ams != 'all' && isset($ams)){echo 'checked';}; ?>>
              <label for="ams0">未送信</label>
              <input type="radio" name="accepted_mail_state" value="1" id="ams1" <?php if($ams == 1){echo 'checked';}; ?>>
              <label for="ams1">送信済</label>
            </div>
          </td>
        </tr>
        <tr>
          <th>入金メール送信状態：</th>
          <td class="pms">
          	<div class="pmsSlctd slctd"></div>
            <div class="option">
              <input type="radio" name="paid_mail_state" value="all" id="pmsAll" <?php if($pms == 'all' || !isset($pms)){echo 'checked';}; ?>>
              <label for="pmsAll">全て</label>
              <input type="radio" name="paid_mail_state" value="0" id="pms0" <?php if($pms == 0 && $pms != 'all' && isset($pms)){echo 'checked';}; ?>>
              <label for="pms0">未送信</label>
              <input type="radio" name="paid_mail_state" value="1" id="pms1" <?php if($pms == 1){echo 'checked';}; ?>>
              <label for="pms1">送信済</label>
            </div>
          </td>
        </tr>
        <tr>
          <th>発送メール送信状態：</th>
          <td class="dms">
          	<div class="dmsSlctd slctd"></div>
            <div class="option">
              <input type="radio" name="delivered_mail_state" value="all" id="dmsAll" <?php if($dms == 'all' || !isset($dms)){echo 'checked';}; ?>>
              <label for="dmsAll">全て</label>
              <input type="radio" name="delivered_mail_state" value="0" id="dms0" <?php if($dms == 0 && $dms != 'all' && isset($dms)){echo 'checked';}; ?>>
              <label for="dms0">未送信</label>
              <input type="radio" name="delivered_mail_state" value="1" id="dms1" <?php if($dms == 1){echo 'checked';}; ?>>
              <label for="dms1">送信済</label>
            </div>
          </td>
        </tr>
        <tr>
          <td colspan="2">
            <input type="submit" value="検索">
            <a href="<?php echo ROOT ?>admin/">Reset</a>
          </td>
        </tr>
      </table>
    </form>
  </section>
	<section class="listArea">
    <!---------------------
    　表タイトル部分
    ----------------------->
    <table>
      <tr>
        <th class="num"></th>
        <th class="status">ステータス</th>
        <th class="id">受注番号</th>
        <th class="makeDate">受注日時</th>
        <th class="cName">お名前</th>
        <th class="total">売上金額</th>
        <th class="mailA">受注確認メール</th>
        <th class="mailP">入金メール</th>
        <th class="mailD">発送メール</th>
      </tr>
			<?php
			$order_no_link = 'http://admin.shop-pro.jp/?mode=order_no_lst';
			$mail_link = 'http://admin.shop-pro.jp/?mode=sales_sendmail&sales_id=';
			/*---------------------
			　受注データ
			---------------------*/
			$data_limit = 10;//1ページに表示するデータ数
			if($_GET['page'] == 1 || empty($_GET['page'])){
				$min = 0;//1ページ目に表示するデータ
			}else{
				$min = ($_GET['page'] - 1)*$data_limit;//2ページ目以降に表示するデータ
			};
			$last = $min + $data_limit;//ページの最後のデータ
			
			for($cnt=$min; $cnt<$last; $cnt++){
				if(!empty($rj['sales'][$cnt]['id'])):
					$num = $cnt+1;//データ番号
					
					/*---- ▼ 動的変数 ▼ -------------------------------------------------------------*/
					$now_mail = 0;//メール作成リンクを表示するかフラグ
					$accepted_mail_state = $rj['sales'][$cnt]['accepted_mail_state'];
					$paid_mail_state = $rj['sales'][$cnt]['paid_mail_state'];
					$delivered_mail_state = $rj['sales'][$cnt]['delivered_mail_state'];
					$id = $rj['sales'][$cnt]['id'];
					$make_date = $rj['sales'][$cnt]['make_date'];
					$c_name = $rj['sales'][$cnt]['customer']['name'];
					$c_furigana = $rj['sales'][$cnt]['customer']['furigana'];
					$c_postal = $rj['sales'][$cnt]['customer']['postal'];
					$c_address = $rj['sales'][$cnt]['customer']['pref_name'].$rj['sales'][$cnt]['customer']['address1'].$rj['sales'][$cnt]['customer']['address2'];
					$c_tel = $rj['sales'][$cnt]['customer']['tel'];
					$c_fax = $rj['sales'][$cnt]['customer']['fax'];
					$c_mail = $rj['sales'][$cnt]['customer']['mail'];
					$total_price = number_format($rj['sales'][$cnt]['total_price']);
					$delivery_total_charge = number_format($rj['sales'][$cnt]['delivery_total_charge']);
					$fee = number_format($rj['sales'][$cnt]['fee']);
					$tax = number_format($rj['sales'][$cnt]['tax']);
					$product_total_price = number_format($rj['sales'][$cnt]['product_total_price']);
					$d_name = $rj['sales'][$cnt]['sale_deliveries'][0]['name'];
					$d_furigana = $rj['sales'][$cnt]['sale_deliveries'][0]['furigana'];
					$d_postal = $rj['sales'][$cnt]['sale_deliveries'][0]['postal'];
					$d_address = $rj['sales'][$cnt]['sale_deliveries'][0]['pref_name'].$rj['sales'][$cnt]['sale_deliveries'][0]['address1'].$rj['sales'][$cnt]['sale_deliveries'][0]['address2'];
					$d_tel = $rj['sales'][$cnt]['sale_deliveries'][0]['tel'];
					$make_day = date('Y/m/d',$make_date);
					$sale_deliveries_id = $rj['sales'][$cnt]['sale_deliveries'][0]['id'];
					$d_delivery_charge = $rj['sales'][$cnt]['sale_deliveries'][0]['delivery_charge'];
					$d_method = $rj6["deliveries"][0]["name"];
/*---- ▼ 商品 ▼ -------------------------------------------------------------*/
/*$i=0;
$product = '';
while(!empty($rj['sales'][$cnt]['details'][$i])){
$product .= '
----------------------------------------------------------------
【　商　品　Ｉ　Ｄ　】 '.$rj['sales'][$cnt]['details'][$i]['product_id'].'
【　商　品　番　号　】 '.$rj['sales'][$cnt]['details'][$i]['product_model_number'].'
【　商　　品　　名　】 '.$rj['sales'][$cnt]['details'][$i]['product_name'];
if(isset($rj['sales'][$cnt]['details'][$i]['option1_value'])){
	$product .= ' '.$rj['sales'][$cnt]['details'][$i]['option1_value'];
};
if(isset($rj['sales'][$cnt]['details'][$i]['option2_value'])){
	$product .= ' '.$rj['sales'][$cnt]['details'][$i]['option2_value'];
};
$product .= '
【　価　格　(税込)　】 '.number_format($rj['sales'][$cnt]['details'][$i]['price_with_tax']).'円
【　　数　　　量　　】 '.$rj['sales'][$cnt]['details'][$i]['product_num'].$rj['sales'][$cnt]['details'][$i]['unit'].'
【　　小　　　計　　】 '.number_format($rj['sales'][$cnt]['details'][$i]['subtotal_price']).'円';
$i++;
};*/
/*-----------------------------------------------------------------*/
					/*-- ステータス判定 --*/
					$status = array('未受付','受付済','入金済','発送済','キャンセル');
					$status_class = array('noAc','acc','paid','deli','cancel');
					
					if($rj['sales'][$cnt]['canceled']){ $sa = 4;
					}elseif($rj['sales'][$cnt]['delivered']){ $sa = 3;
					}elseif($rj['sales'][$cnt]['paid']){ $sa = 2;
					}elseif(!empty($rj['sales'][$cnt]['accepted_mail_sent_date'])){ $sa = 1;
					}else{ $sa = 0; };
					
					$data = '<tr class="'.$status_class[$sa].'">';
					$data .= '<td class="num">'.$num.'</td>';//番号
					$data .= '<td class="status">'.$status[$sa].'</td>';//ステータス
					if(isset($_GET['page'])){
						$page = '&page='.$_GET['page'];
					}else{ $page = ''; };
					
					$data .= '<td class="id"><a href="detail.php?id='.$id.$page.$search.'" target="_blank">'.$id.'</a></td>';//受注番号
					$data .= '<td class="makeDate">'.date('Y/m/d H:i',$make_date).'</td>';//受注日時
					$data .= '<td class="cName">'.$c_name.' 様</td>';//お名前
					$data .= '<td class="total">'.$total_price.'円</td>';//売上金額
					
					
					/*---------------------
					　受注確認メール
					---------------------*/
					/*
					mail_type=0：受注時自動送信メール
					mail_type=1：受注確認メール
					mail_type=2：入金確認メール
					mail_type=3：発送メール
					*/
					
					$now_mail = '';
					$mail_type = '';
					$date_accepted = '';
					if($accepted_mail_state == 'not_yet'){
						$status_accepted = '未送信';
						$now_mail = 1;
						$mail_type = 1;
					}elseif($accepted_mail_state == 'sent'){
						$status_accepted = '送信済み';
						$date_accepted = date('Y/m/d H:i',$rj['sales'][$cnt]['accepted_mail_sent_date']);
						$now_mail = 1;
						$mail_type = 1;
					}elseif($accepted_mail_state == 'pass'){
						$status_accepted = '送信しない';
					}else{
						$status_accepted = '不明';
					};
					$data .= '<td class="mailA"><p class="'.$accepted_mail_state.'">'.$status_accepted.'</p>';
					if($now_mail == 1){
						$data .= '<a class="mailon ti-email" data-id="id'.$id.'1"></a>';
					};
					if(!empty($date_accepted)){
						$data .= '<br><span class="date">'.$date_accepted.'</span>';
					};
					$data .= '<div class="popup" style="display:none;"><form action="../inc/mail.php?'.$page.$search.'" method="post" id="id'.$id.'1">';
					$data .= '<input type="hidden" name="cnt" value="'.$cnt.'"><input type="hidden" name="mail_type" value="'.$mail_type.'"><input type="hidden" name="sale_deliveries_id" value="'.$sale_deliveries_id.'">';
					$data .= '<p>';
					if($accepted_mail_state == 'not_yet' && $sa == 0){
						$data .= '受注確認メールを送信して<br>ステータスを受付済みにしてもよろしいですか？';
					}elseif($accepted_mail_state == 'not_yet' && $sa > 0){
						$data .= '受注確認メールを送信してもよろしいですか？';
					}elseif($accepted_mail_state != 'not_yet'){
						$data .= '受注確認メールを再送信してもよろしいですか？';
					};
					$data .= '</p><button type="submit" name="thisid" value="'.$id.'">送信</button><a class="cancel">キャンセル</a><a class="mail_edit" href="'.$mail_link.$id.'&mail_type='.$mail_type.'" target="_blank">> メールの内容を編集する</a><span>※予めカラーミーショップに<a href="http://admin.shop-pro.jp" target="_blank">ログイン</a>してください</span><div class="mailConfBg" style="display:none;"></div></form></div>';
					$data .= '</td>';

			
					/*---------------------
					　入金メール
					---------------------*/
					$now_mail = '';
					$mail_type = '';
					$date_paid_mail = '';
					if($paid_mail_state == 'not_yet'){
						$status_paid_mail = '未送信';
						$now_mail = 1;
						$mail_type = 2;
					}elseif($paid_mail_state == 'sent'){
						$status_paid_mail = '送信済み';
						$date_paid_mail = date('Y/m/d H:i',$rj['sales'][$cnt]['paid_mail_sent_date']);
						$now_mail = 1;
						$mail_type = 2;
					}elseif($paid_mail_state == 'pass'){
						$status_paid_mail = '送信しない';
					}else{
						$status_paid_mail = '不明';
					};
					$data .= '<td class="mailP"><p class="'.$paid_mail_state.'">'.$status_paid_mail.'</p>';
					if($now_mail == 1){
						$data .= '<a class="mailon ti-email" data-id="id'.$id.'2"></a>';
					};
					if(!empty($date_paid_mail)){
						$data .= '<br><span class="date">'.$date_paid_mail.'</span>';
					};
					$data .= '<div class="popup" style="display:none;"><form action="../inc/mail.php?'.$page.$search.'" method="post" id="id'.$id.'2">';
					$data .= '<input type="hidden" name="cnt" value="'.$cnt.'"><input type="hidden" name="mail_type" value="'.$mail_type.'"><input type="hidden" name="sale_deliveries_id" value="'.$sale_deliveries_id.'">';
					$data .= '<p>';
					if($paid_mail_state == 'not_yet' && $sa < 2){
						$data .= '入金確認メールを送信して<br>ステータスを入金済みにしてもよろしいですか？';
					}elseif($paid_mail_state == 'not_yet' && $sa >= 2){
						$data .= '入金確認メールを送信してもよろしいですか？';
					}elseif($paid_mail_state != 'not_yet'){
						$data .= '入金確認メールを再送信してもよろしいですか？';
					};
					$data .= '</p><button type="submit" name="thisid" value="'.$id.'">送信</button><a class="cancel">キャンセル</a><a class="mail_edit" href="'.$mail_link.$id.'&mail_type='.$mail_type.'" target="_blank">> メールの内容を編集する</a><span>※予めカラーミーショップに<a href="http://admin.shop-pro.jp" target="_blank">ログイン</a>してください</span><div class="mailConfBg" style="display:none;"></div></form>';
					if($sa < 2){//ステータスが未受付(0)か受付済(1)の場合
						$data .= '<form action="../inc/mail.php?'.$page.$search.'" method="post" id="id'.$id.'2">';
					$data .= '<input type="hidden" name="cnt" value="'.$cnt.'"><input type="hidden" name="mail_type" value="'.$mail_type.'"><input type="hidden" name="sale_deliveries_id" value="'.$sale_deliveries_id.'"><input type="checkbox" name="not_mail" value="1" checked>';
					$data .= '<p>または、<br>メールを送信せずにステータスのみ入金済みに変更する</p><button type="submit" name="thisid" value="'.$id.'">ステータスのみ変更</button></form>';
					}
					$data .= '</div></td>';
			
					/*---------------------
					　発送メール
					---------------------*/
					$now_mail = '';
					$mail_type = '';
					$date_delivered_mail = '';
					if($delivered_mail_state == 'not_yet'){
						$status_delivered_mail = '未送信';
						$now_mail = 1;
						$mail_type = 3;
					}elseif($delivered_mail_state == 'sent'){
						$status_delivered_mail = '送信済み';
						$date_delivered_mail = date('Y/m/d H:i',$rj['sales'][$cnt]['delivered_mail_sent_date']);
						$now_mail = 1;
						$mail_type = 3;
					}elseif($delivered_mail_state == 'pass'){
						$status_delivered_mail = '送信しない';
					}else{
						$status_delivered_mail = '不明';
					};
					$data .= '<td class="mailD"><p class="'.$delivered_mail_state.'">'.$status_delivered_mail.'</p>';
					if($now_mail == 1){
						$data .= '<a class="mailon ti-email" data-id="id'.$id.'3"></a>';
					};
					if(!empty($date_delivered_mail)){
						$data .= '<br><span class="date">'.$date_delivered_mail.'</span>';
					};
					$data .= '<div class="popup" style="display:none;"><form action="../inc/mail.php?'.$page.$search.'" method="post" id="id'.$id.'3">';
					$data .= '<input type="hidden" name="cnt" value="'.$cnt.'"><input type="hidden" name="mail_type" value="'.$mail_type.'"><input type="hidden" name="sale_deliveries_id" value="'.$sale_deliveries_id.'">';
					$data .= '<p>';
					if($delivered_mail_state == 'not_yet' && $sa < 3){
						$data .= '発送メールを送信して<br>ステータスを発送済みにしてもよろしいですか？';
					}elseif($delivered_mail_state == 'not_yet' && $sa >= 3){
						$data .= '発送メールを送信してもよろしいですか？';
					}elseif($delivered_mail_state != 'not_yet'){
						$data .= '発送メールを再送信してもよろしいですか？';
					};
					$data .= '</p><button type="submit" name="thisid" value="'.$id.'">送信</button><a class="cancel">キャンセル</a><a class="mail_edit" href="'.$mail_link.$id.'&mail_type='.$mail_type.'" target="_blank">> メールの内容を編集する</a><span>※予めカラーミーショップに<a href="http://admin.shop-pro.jp" target="_blank">ログイン</a>してください</span><div class="mailConfBg" style="display:none;"></div></form>';
					if($sa < 3){//ステータスが発送済み(3)かキャンセル(4)ではない場合
						$data .= '<form action="../inc/mail.php?'.$page.$search.'" method="post" id="id'.$id.'3">';
					$data .= '<input type="hidden" name="cnt" value="'.$cnt.'"><input type="hidden" name="mail_type" value="'.$mail_type.'"><input type="hidden" name="sale_deliveries_id" value="'.$sale_deliveries_id.'"><input type="checkbox" name="not_mail" value="1" checked>';
					$data .= '<p>または、<br>メールを送信せずにステータスのみ送信済みに変更する</p><button type="submit" name="thisid" value="'.$id.'">ステータスのみ変更</button></form>';
					}
					$data .= '</div></td>';
					
					echo $data.'</tr>';
				else://データがない場合
					if($cnt == 0){
						echo '<tr class="no_data"><td colspan="9">No data</td></tr>';
						$no_data = 1;
					};
					echo '</table>';
					break;
				endif;
				
				if($cnt == $last-1){ echo '</table>'; };//ページに表示する最後のデータの場合
			};//繰り返し終了
			
			if($no_data != 1){
				echo '<div class="mailBg" style="display:none;"></div>';
				
				/*---------------------
				　ページ番号
				---------------------*/
				$cnt_start = $min+1;
				$cnt_last = $num;
				$pre = $_GET['page']-1;
				if(empty($_GET['page'])){ $next = 2;
				}else{ $next = $_GET['page']+1; };
				
				$page_num = '<div class="pageNum">';
				if($_GET['page'] > 1){
					$page_num .= '<a class="pre" href="./?page='.$pre.$search.'">&#8249;</a> ';
				};
				$page_num .= '<span>'.$cnt_start.'〜'.$cnt_last.'/'.$rj['meta']['total'].'(Max.50件)</span>';
				if($rj['meta']['total'] > $cnt_last){
					$page_num .= '<a class="next" href="./?page='.$next.$search.'">&#8250;</a>';
				};
				echo $page_num.'</div>';
			};
		?>
  </section>
  <footer>
  	<a href="http://admin.shop-pro.jp" target="_blank">カラーミーショップ管理画面</a>
  </footer>
</body>
</html>