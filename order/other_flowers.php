
<section class="other season">
	<?php if($season_open == 1){ ?>
	<h2 class="ul seasons_ttl"><img src="<?php echo ROOT ?>img/season/ttl_mothers_day.png" alt="2018 Mother's Day (母の日)"></h2>
  <a href="<?php echo ROOT ?>order/arrangement_mothers_day/" class="seasons_thum">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/season/arrangement_mothers_day1.jpg)"></span>
    <h3>Arrangement<span class="more">¥5,000〜</span></h3>
  </a>
  <a href="<?php echo ROOT ?>order/bouquet_mothers_day/" class="seasons_thum">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/season/bouquet_mothers_day1.jpg)"></span>
    <h3>Bouquet<span class="more">¥5,000〜</span></h3>
  </a>
	<?php } ?>

	<h2 class="ul">Other flowers</h2>
  <?php if($order_filename != 'arrangement'){ ?>
  <a href="<?php echo ROOT ?>order/arrangement/">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/arrangement1.jpg)"></span>
    <h3>Arrangement<span class="more">¥5,400〜</span></h3>
  </a>
	<?php };
	if($order_filename != 'bouquet'){ ?>
  <a href="<?php echo ROOT ?>order/bouquet/">
    <h3>Bouquet<span class="more">¥3,780〜</span></h3>
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/bouquet1.jpg)"></span>
  </a>
	<?php };
	if($order_filename != 'stand_flower'){ ?>
  <a href="<?php echo ROOT ?>order/stand_flower/">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/stand_flower1.jpg)"></span>
    <h3>Stand flower<span class="more">¥21,600〜</span></h3>
  </a>
	<?php };
	if($order_filename != 'foliage_plants'){ ?>
  <a href="<?php echo ROOT ?>order/foliage_plants/">
    <h3>Foliage plants<span class="more">¥10,800〜</span></h3>
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/foliage_plants1.jpg)"></span>
  </a>
	<?php };
	if($order_filename != 'orchid'){ ?>
  <a href="<?php echo ROOT ?>order/orchid/">
  	<span class="photo" style="background-image:url(<?php echo ROOT ?>img/product/orchid1.jpg)"></span>
    <h3>Orchid<span class="more">¥16,200〜</span></h3>
  </a>
	<?php }; ?>
</section>
