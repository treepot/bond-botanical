<?php
$filepath = __FILE__;
include '../inc/site.php';
include ROOTDIR.'inc/head.php';

$order_filename = pathinfo(__FILE__, PATHINFO_FILENAME);
?>
<?php include ROOTDIR.'inc/header.php' ?>

<section class="product_detail clearfix">
	<a href="<?php echo ROOT ?>order/" class="back ti-angle-left"><span class="pc pad">Order</span></a>
  <h1>Foliage Plants</h1>
	<div class="product_img">
  	<div class="display_img">
    	<?php
			$cnt = 1;
			while ($cnt < 20){
				$file = ROOTDIR.'img/product/'.$order_filename.$cnt.'.jpg';
				if($cnt == 1){ $display = ' class="display"';}else{ $display = '';};
				if (file_exists($file)) {
					echo '<img src="'.ROOT.'img/product/'.$order_filename.$cnt.'.jpg" data-img="'.$cnt.'"'.$display.'>';
					$cnt++;
				}else{
					break;
				}
			};
			?>
    </div>
    <div class="thum">
    	<?php
			$cnt = 1;
			while ($cnt < 20){
				$file = ROOTDIR.'img/product/'.$order_filename.$cnt.'.jpg';
				if($cnt == 1){ $active = ' class="active"';}else{ $active = '';};
				if (file_exists($file)) {
					echo '<span style="background-image:url('.ROOT.'img/product/'.$order_filename.$cnt.'.jpg);" data-thum="'.$cnt.'"'.$active.'></span>';
					$cnt++;
				}else{
					break;
				}
			}
			?>
    </div>
  </div>
  <div class="detail2">
  	<p>ご注文の場合、オーダーシートから<br>
    お電話でもお受けできます<br>
    TEL　06-6222-2287</p>
  </div>
  <a class="order" href="<?php echo ROOT ?>order_sheet?flower_type=foliage_plants">Order Sheet</a>
</section>
<?php
include ROOTDIR.'order/other_flowers.php';
include ROOTDIR.'inc/footer.php';
?>

<script>
$(function() {
	// サムネール画像選択時
	$('.product_img>.thum>span').on('click', function() {
		// 独自データを取得
		var data = $(this).data('thum');
		$('.product_img>.thum>span.active').removeClass('active');
		$('.product_img>.thum>span[data-thum="' + data + '"]').addClass('active');
		$('section.product_detail>.product_img>.display_img>img.display').stop().css('z-index','2').fadeOut().removeClass('display');
		if(data == 'color'){ cn = selected_color;}else{ cn = '';};
		$('section.product_detail>.product_img>.display_img>img[data-img="' + data + cn + '"]').stop().css('z-index','1').fadeIn().addClass('display');
	});
});
</script>