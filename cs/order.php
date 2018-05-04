<?php
$filepath = __FILE__;
include './inc/site.php';
include ROOTDIR.'inc/head.php';
include ROOTDIR."inc/header.php";
?>

<h1><?php echo $title[$page] ?></h1>

<section class="lineup">
	<div class="h2o">
    <h3>How to order</h3>
    <p>
    	<strong>WEB、 FAX 、お電話にてご注文いただけます</strong><br>
      
    	<span>ブーケ・アレンジのご購入の方は買物カゴからご注文いただけます</span><br>
    	<span>その他スタンド・胡蝶蘭・観葉植物などはWEBページ内のオーダーフォームから必要事項を入力送信して頂き、<br class="pc">内容確認の為、折り返しご連絡させて頂きます</span><br>
    	<span>すべての商品はFAXでもご注文いただけます<br>FAXオーダーシートをダウンロードして頂き、必要事項ご記入後、FAX送信してください<br>内容確認後、折返しご連絡させていただきます</span>
  	</p>
  </div>
  
	<h2>Lineup of Flowers</h2>
  <a href="<?php echo ROOT ?>order/arrangement/">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/arrangement1.jpg)"></span>
    <h3>Arrangement<span class="more">¥5,400〜</span></h3>
  </a><!--
  --><a href="<?php echo ROOT ?>order/bouquet/">
    <h3>Bouquet<span class="more">¥3,780〜</span></h3>
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/bouquet1.jpg)"></span>
  </a><br class="pc pad">
  <a href="<?php echo ROOT ?>order/stand_flower/">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/stand_flower1.jpg)"></span>
    <h3>Stand flower<span class="more">¥21,600〜</span></h3>
  </a><!--
  --><a href="<?php echo ROOT ?>order/foliage_plants/">
    <h3>Foliage plants<span class="more">¥10,800〜</span></h3>
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/foliage_plants1.jpg)"></span>
  </a><!--
  --><a href="<?php echo ROOT ?>order/orchid/">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/orchid1.jpg)"></span>
    <h3>Orchid<span class="more">¥16,200〜</span></h3>
  </a>
  <div class="fax">
  	<a href="<?php echo ROOT ?>pdf/fax_order_sheet.pdf" target="_blank" class="fax_sheet amiri"><i class="fa fa-print" aria-hidden="true"></i>FAX Order Sheet<span>(<i class="fa fa-file-pdf-o" aria-hidden="true"></i>PDF)</span></a>
  </div>
</section>

<!--preserved-->

<?php include ROOTDIR."inc/footer.php" ?>
