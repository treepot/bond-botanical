<?php
$filepath = __FILE__;
include '../inc/site.php';
include ROOTDIR.'inc/head.php';

$order_filename = pathinfo(__FILE__, PATHINFO_FILENAME);
?>
<?php include ROOTDIR.'inc/header.php' ?>

<section class="product_detail cc clearfix">
	<a href="<?php echo ROOT ?>order/" class="back ti-angle-left"><span class="pc pad">Order</span></a>
  <h1>Bouquet</h1>
	<div class="product_img">
  	<div class="display_img">
    	<?php			
			//カラー毎の画像
			for ($cnt = 0; $cnt <= 6; $cnt++){
				$cnt2 = 1;
				while ($cnt2 < 20){
					$file = ROOTDIR.'img/color/'.$order_filename.'/'.$color_val[$cnt].$cnt2.'.jpg';
					if($cnt == 0 && $cnt2 == 1){ $display = ' display';}else{ $display = '';};
					if (file_exists($file)) {
						echo '<img class="'.$color_val[$cnt].$cnt2.$display.'" src="'.ROOT.'img/color/'.$order_filename.'/'.$color_val[$cnt].$cnt2.'.jpg" data-img="'.$color_val[$cnt].$cnt2.'">';
						$cnt2++;
					}else{
						break;//while
					}
				}
			};
			?>
    </div>
    <div class="thum">
    	<?php
			for ($cnt = 0; $cnt <= 6; $cnt++){
				$cnt2 = 1;
				while ($cnt2 < 20){
					$file = ROOTDIR.'img/color/'.$order_filename.'/'.$color_val[$cnt].$cnt2.'.jpg';
					if($cnt == 0 && $cnt2 == 1){ $active = ' active';}else{ $active = '';};
					if($cnt == 0){ $display = 'on';}else{ $display = 'off';};
					if (file_exists($file)) {
						echo '<span style="background-image:url('.ROOT.'img/color/'.$order_filename.'/'.$color_val[$cnt].$cnt2.'.jpg);" data-thum="'.$cnt.'" class="'.$color_val[$cnt].$cnt2.' '.$display.$active.'"></span>';
						$cnt2++;
					}else{
						break;//while
					}
				}
			};
			?>
    </div>
  </div>
  <div class="th">
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
	<script type='text/javascript' src='<?php echo $shop_url ?>?mode=cartjs&pid=<?php echo $product_id[2] ?>&style=basic&name=n&img=y&expl=n&stock=n&price=y&inq=n&sk=y' charset='euc-jp'></script>
  </div>
  <div class="paypal_info">
	  <p><b><span>※</span>表示金額は送料込みです</b><br>
    <b><span>※</span>メッセージカード・立札ご希望の方は、備考欄にご記入ください</b><br>
    <span>※</span>クレジットカードをご利用の場合はお支払い方法画面でPaypalを選択してください<br>
    Paypalをご利用の際は予め登録が必要になります</p>
    <p><a href="https://www.paypal.com/jp/webapps/mpp/personal" target="_blank">Paypal(ペイパル)とは？</a><br>
    <a href="https://www.paypal.com/jp/webapps/mpp/personal/how-paypal-works" target="_blank">ペイパルの使い方・支払い方法</a></p>
  </div>
  <div class="detail">
  	<p>ブーケとはお花を束ねて作る花束の事<br>
    お誕生日や歓迎会、送別会、何にもない日に送るのも素敵です<br>
    <br>
    "ラウンドブーケ"とはお花をギュッと集めてお作りするブーケの事<br>
    おしゃれな方にプレゼントする時、あまりおおげさにしたくない時はラウンドブーケをお勧めします<br>
    <br>
    舞台や結婚式など広い会場でお贈りになる場合は、"ロングブーケ"という丈の長いタイプもございます</p>
    <p>ロングタイプやお花の詳細など、ご指定がございましたら、<a href="<?php echo ROOT ?>order_sheet?flower_type=bouquet">こちら</a>からご注文ください</p>
  </div>
</section>
<?php
include ROOTDIR.'order/other_flowers.php';
include ROOTDIR.'inc/footer.php';
?>

<script>
$(function() {
	/* カラー選択時に画像変更 */
	var color_val = ['white_green','yellow_orange','purple','pink','red','antique','count_on'];
	// 選択値を取得
	/*var selected_color_val = $('.product_detail.cc .cartjs_box .cartjs_option1 select[name="option1"]').val();
	selected_color = selected_color_val.slice(-1);*/
	
	// カラーが変更された時
	$('.product_detail.cc .cartjs_box .cartjs_option1 select[name="option1"]').change(function(){
		// 選択値を再取得
		var selected_color_val = $('.product_detail.cc .cartjs_box .cartjs_option1 select[name="option1"]').val();
		selected_color = selected_color_val.slice(-1);
		
		// 表示されている画像をfadeout
		$('section.product_detail>.product_img>.display_img>img.display').css('z-index','2').fadeOut().removeClass('display');
		// 選択されたカラー画像を表示
		$('section.product_detail>.product_img>.display_img>img[data-img="' + color_val[selected_color] + '1"]').css('z-index','1').fadeIn().addClass('display');
		
		// サムネールのカラー画像を変更
		$('.product_img>.thum>span:not([data-thum="' + selected_color + '"])').removeClass('on').addClass('off');
		$('.product_img>.thum>span[data-thum="' + selected_color + '"]').removeClass('off').addClass('on');
		$('.product_img>.thum>span.active').removeClass('active');
		$('.product_img>.thum>span.' + color_val[selected_color]+ '1').addClass('active');

	});
	// サムネール画像選択時
	$('.product_img>.thum>span').on('click', function() {
		// 独自データを取得
		var classVal = $(this).attr('class');
		var classVals = classVal.split(' ');
		$('.product_img>.thum>span.active').removeClass('active');
		$(this).addClass('active');
		$('section.product_detail>.product_img>.display_img>img.display').stop().css('z-index','2').fadeOut().removeClass('display');
		$('section.product_detail>.product_img>.display_img>img[data-img="' + classVals[0] + '"]').stop().css('z-index','1').fadeIn().addClass('display');
	});
});
</script>