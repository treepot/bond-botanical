<?php
$filepath = __FILE__;
include '../inc/site.php';
include ROOTDIR.'inc/head.php';

$order_filename = pathinfo(__FILE__, PATHINFO_FILENAME);//arrangement
?>
<?php include ROOTDIR.'inc/header.php' ?>

<section class="product_detail cc clearfix season">
	<a href="<?php echo ROOT ?>order/" class="back ti-angle-left"><span class="pc pad">Order</span></a>
  <h1><span><img src="<?php echo ROOT ?>img/season/ttl_mothers_day.png" alt="2018 Mother's Day (母の日)"></span>Bouquet</h1>
	<div class="product_img">
  	<div class="display_img">
    	<?php
			$cnt = 1;
			while ($cnt < 20){
				$file = ROOTDIR.'img/season/'.$order_filename.$cnt.'.jpg';
				if($cnt == 1){ $display = ' class="display"';}else{ $display = '';};
				if (file_exists($file)) {
					echo '<img src="'.ROOT.'img/season/'.$order_filename.$cnt.'.jpg" data-img="'.$cnt.'"'.$display.'>';
					$cnt++;
				}else{
					break;
				}
			};
			?>
    </div>
  </div>
  <div class="th">
  	<!--<p>Type</p>-->
  	<p>Quantity</p>
    <p>Color</p>
    <p>Size + Price<span>（税込価格）</span></p>
  </div>
  <div class="quantity">
    <select name="quantity">
    	<?php
				for($i = 1; $i <= 30; $i++){
					echo '<option value="'.$i.'">'.$i.'</option>';
				}
			?>
    </select>
  </div>
  <div class="colormejs clearfix">
		<script type='text/javascript' src='<?php echo $shop_url ?>?mode=cartjs&pid=<?php echo $product_id[6] ?>&style=basic&name=n&img=y&expl=n&stock=n&price=y&inq=n&sk=y' charset='euc-jp'></script>
  </div>
  <div class="paypal_info">
	  <p>
			<b><span>※</span>商品写真は10,000円のgreenになります</b><br>
	  	<b><span>※</span>表示金額は消費税・送料込みです</b><br>
    	<span>※</span>クレジットカードをご利用の場合はお支払い方法画面でPaypalを選択してください<br>
    	Paypalをご利用の際は予め登録が必要になります
		</p>
    <p><a href="https://www.paypal.com/jp/webapps/mpp/personal" target="_blank">Paypal(ペイパル)とは？</a><br>
    <a href="https://www.paypal.com/jp/webapps/mpp/personal/how-paypal-works" target="_blank">ペイパルの使い方・支払い方法</a></p>
  </div>
  <div class="detail">
  	<p>5月13日(日)は母の日 <br class="sp">感謝の気持ちをお花に込めて...<br>
			今年は pink と green の2色からお選びいただけます<br><br>
			ご注文は<b style="font-weight: bold;">8日(火)</b>で締め切らせて頂きます<br>
			全ての商品に Thanks mother のカードが付きます<br>
			使用花材は全てお任せいただきます
		</p>
  </div>
</section>
<?php
include ROOTDIR.'order/other_flowers.php';
include ROOTDIR.'inc/footer.php';
?>
