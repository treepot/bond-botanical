<?php include '../inc/site.php' ?>
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<!--<meta name="viewport" content="width=device-width,initial-scale=1.0">-->
<meta name="format-detection" content="telephone=no" />
<title>bois de gui | 売上管理</title>
<link rel="stylesheet" href="<?php echo ROOT ?>css/common.css">
<link rel="stylesheet" href="<?php echo ROOT ?>css/admin.css">
<link rel="stylesheet" href="<?php echo ROOT ?>css/themify-icons.css"><!-- https://themify.me/themify-icons -->
<script src="<?php echo ROOT ?>js/jquery.min.js"></script>
<script src="<?php echo ROOT ?>js/jquery.cleanQuery.js"></script>
<script src="<?php echo ROOT ?>js/admin.js"></script>
<script language="JavaScript">
<!--
function tm(){
		//tm = setInterval("location.reload()",10000);
}
//-->
</script>
</head>
<body id="sales" onLoad="tm()">
	<header>
  	<?php include_once ROOTDIR.'admin/admin_header.php' ?>
  </header>
<?php
echo '<!--<pre>';
var_dump($rj7);
echo '</pre>-->';
?>
  <section class="recent clearfix">
    <div class="daily">
      <?php
        $date = date('Y-m-d', $now);
        include ROOTDIR.'inc/stat.php';
      ?>
      <h1>本日<!--(<?php echo date('n/j', $now); ?>)-->の売上<span>&nbsp;(売上件数)</span></h1>
      <p><?php	echo number_format($rj7['sales_stat']['amount_today']);?><span>円</span><span>&nbsp;(<?php echo $rj7['sales_stat']['count_today'];?>)</span></p>
      <?php
        $date = date('Y-m-d', strtotime('yesterday'));
        include ROOTDIR.'inc/stat.php';
      ?>
      <p>昨日：<?php	echo number_format($rj7['sales_stat']['amount_today']);?><span>円</span><span>&nbsp;(<?php echo $rj7['sales_stat']['count_today'];?>)</span></p>
    </div>
    <div class="monthly">
      <?php
        $date = date('Y-m-d', $now);
        include ROOTDIR.'inc/stat.php';
      ?>
      <h1>今月<!--(<?php echo date('n/j', $now); ?>)-->の売上<span>&nbsp;(売上件数)</span></h1>
      <p><?php	echo number_format($rj7['sales_stat']['amount_this_month']);?><span>円</span><span>&nbsp;(<?php echo $rj7['sales_stat']['count_this_month'];?>)</span></p>
      <?php
      	$this_day_first = date('Y-m-01', $now);//今月1日
        $date = date('Y-m-d', strtotime($this_day_first.'-1 month'));
        include ROOTDIR.'inc/stat.php';
      ?>
      <p>先月：<?php	echo number_format($rj7['sales_stat']['amount_this_month']);?><span>円</span><span>&nbsp;(<?php echo $rj7['sales_stat']['count_this_month'];?>)</span></p>
    </div>
  </section>
  <section id="past30" class="graphArea">
  	<h1>過去30日間の売上</h1>
  	<div class="graph clearfix">
  	<?php
			$cmax = array();
			for($d = -29; $d < 1; $d++){
    		$date = date('Y-m-d', strtotime($d.' day', $now));
        include ROOTDIR.'inc/stat.php';
				array_push($cmax, $rj7['sales_stat']['amount_today']);
			};
			$max = max($cmax);//最大値
			if($max != 0){
				$max1 = substr($max, 0, 1);
				$max2 = substr($max, 1, 1);
				if($max2 <= 1){
					$approx = 0;
					$r_up = 0;
				}elseif($max2 >= 2 && $max2 <= 6){
					$approx = 5;
					$r_up = 0;
				}elseif($max2 >= 7){
					$approx = 0;
					$r_up = 1;
				};
				if($r_up == 1){
					$max_scale = substr_replace($max, $max1+1, 0, 1);//上から1桁目繰り上げ
				}else{$max_scale = $max;};
				$max_scale = substr_replace($max_scale, $approx, 1, 1);//上から2桁目を0か5に変換
				$str_b = array(1,2,3,4,5,6,7,8,9);
				$str_a = array(0,0,0,0,0,0,0,0,0);
				$r_off = str_replace($str_b, $str_a, substr($max_scale, 2));
				$max_scale = substr($max_scale, 0, 2).$r_off;
				$max_scale12 = substr($max_scale, 0, 2);//調整された最大値の上から2桁取得
				$check2 = ctype_digit(strval($max_scale12 / 2));//2で割ったものが整数か(文字(小数点)が入らないか)
				$check22 = ctype_digit(strval($max_scale12 / 4));
				$check3 = ctype_digit(strval($max_scale12 / 3));
				echo '<span class="scale" style="bottom: 300px;"><p>', number_format($max_scale), '円</p></span>';
				if($check3){
					echo '<span class="scale" style="bottom: 200px;"><p>', number_format($max_scale * 2 / 3), '円</p></span>';
					echo '<span class="scale" style="bottom: 100px;"><p>', number_format($max_scale / 3), '円</p></span>';
				}elseif($check2){
					if($check22){
						echo '<span class="scale" style="bottom: 225px;"><p>', number_format($max_scale * 3 / 4), '円</p></span>';
						echo '<span class="scale" style="bottom: 150px;"><p>', number_format($max_scale / 2), '円</p></span>';
						echo '<span class="scale" style="bottom: 75px;"><p>', number_format($max_scale / 4), '円</p></span>';
					}else{
						echo '<span class="scale" style="bottom: 150px;"><p>', number_format($max_scale / 2), '円</p></span>';
					};
				};
				echo '<span class="scale" style="bottom: 0px;"><p>', 0, '円</p></span>';
				$constant = 300 / $max_scale;
			}else{
				echo '<span class="scale" style="bottom: 0px;"><p>', 0, '円</p></span>';
			}
			
			$delay = 0;
			for($d = -29; $d < 1; $d++){
    		$date = date('Y-m-d', strtotime($d.' day', $now));
        include ROOTDIR.'inc/stat.php';
				$this_month = date('n', strtotime($date));
				$this_date = date('j', strtotime($date));
				echo '<div class="data"><a href="'.ROOT.'admin/?after='.$date.'&before='.date('Y-m-d', strtotime( '+1 day', strtotime($date)) ).'" class="h0" data-delay="';
				if($rj7['sales_stat']['amount_today'] > 0){
					$delay++;
					echo $delay;
				}else{
					echo 0;
				};
				echo '" style="height:', $rj7['sales_stat']['amount_today']*$constant , 'px;"><span>'.number_format($rj7['sales_stat']['amount_today']).'円</span></a><span>';
				if($d == -29 || $this_date == 1){
					echo $this_month.'/';
				};
    		echo $this_date, '</span></div>';
			};
		?>
    </div>
  </section>
  <section id="monthly" class="graphArea">
  	<h1>過去1年間の売上</h1>
  	<div class="graph clearfix">
  	<?php
			$cmax2 = array();
			$time = $now;
			$date = date('Y-m-d', $time);
			include ROOTDIR.'inc/stat.php';
			array_push($cmax2, $rj7['sales_stat']['amount_this_month']);
			$this_day_first = date('Y-m-01', $time);//今月1日
			for($count = 0; $count < 11; $count++){
				$date = date('Y-m-d', strtotime($this_day_first.'-1 month'));//先月1日
        include ROOTDIR.'inc/stat.php';
				array_push($cmax2, $rj7['sales_stat']['amount_this_month']);
				$this_day_first = $date;
			};
			$max = max($cmax2);//最大値
			if($max != 0){
				$max1 = substr($max, 0, 1);
				$max2 = substr($max, 1, 1);
				if($max2 <= 1){
					$approx = 0;
					$r_up = 0;
				}elseif($max2 >= 2 && $max2 <= 6){
					$approx = 5;
					$r_up = 0;
				}elseif($max2 >= 7){
					$approx = 0;
					$r_up = 1;
				};
				if($r_up == 1){
					$max_scale = substr_replace($max, $max1+1, 0, 1);//上から1桁目繰り上げ
				}else{$max_scale = $max;};
				$max_scale = substr_replace($max_scale, $approx, 1, 1);//上から2桁目を0か5に変換
				$str_b = array(1,2,3,4,5,6,7,8,9);
				$str_a = array(0,0,0,0,0,0,0,0,0);
				$r_off = str_replace($str_b, $str_a, substr($max_scale, 2));
				$max_scale = substr($max_scale, 0, 2).$r_off;
				$max_scale12 = substr($max_scale, 0, 2);//調整された最大値の上から2桁取得
				$check2 = ctype_digit(strval($max_scale12 / 2));//2で割ったものが整数か(文字(小数点)が入らないか)
				$check22 = ctype_digit(strval($max_scale12 / 4));
				$check3 = ctype_digit(strval($max_scale12 / 3));
				echo '<span class="scale" style="bottom: 300px;"><p>', number_format($max_scale), '円</p></span>';
				if($check3){
					echo '<span class="scale" style="bottom: 200px;"><p>', number_format($max_scale * 2 / 3), '円</p></span>';
					echo '<span class="scale" style="bottom: 100px;"><p>', number_format($max_scale / 3), '円</p></span>';
				}elseif($check2){
					if($check22){
						echo '<span class="scale" style="bottom: 225px;"><p>', number_format($max_scale * 3 / 4), '円</p></span>';
						echo '<span class="scale" style="bottom: 150px;"><p>', number_format($max_scale / 2), '円</p></span>';
						echo '<span class="scale" style="bottom: 75px;"><p>', number_format($max_scale / 4), '円</p></span>';
					}else{
						echo '<span class="scale" style="bottom: 150px;"><p>', number_format($max_scale / 2), '円</p></span>';
					};
				};
				echo '<span class="scale" style="bottom: 0px;"><p>', 0, '円</p></span>';
				$constant = 300 / $max_scale;
			}else{
				echo '<span class="scale" style="bottom: 0px;"><p>', 0, '円</p></span>';
			}
			
			$delay = 0;
			$time = $now;
			$date = date('Y-m-d', $time);
			$this_day_first = date('Y-m-01', $time);//今月1日
			include ROOTDIR.'inc/stat.php';
			$this_month = date('n', strtotime($date));
			$this_yaer = date('Y', strtotime($date));
			echo '<div class="data"><a href="'.ROOT.'admin/?after='.$this_day_first.'&before='.date('Y-m-01', strtotime($this_day_first.'+1 month')).'" class="h0" data-delay="';
			if($rj7['sales_stat']['amount_this_month'] > 0){
				$delay++;
				echo $delay;
			}else{
				echo 0;
			};
			echo '" style="height:', $rj7['sales_stat']['amount_this_month']*$constant , 'px;"><span>'.number_format($rj7['sales_stat']['amount_this_month']).'円</span></a><span>';
			if($this_month == 1){
				echo $this_yaer.'/';
			};
			echo $this_month, '月</span></div>';
			
			for($count = 0; $count < 11; $count++){
				$date = date('Y-m-d', strtotime($this_day_first.'-1 month'));//先月1日
        include ROOTDIR.'inc/stat.php';
				$this_month = date('n', strtotime($date));
				$this_yaer = date('Y', strtotime($date));
				echo '<div class="data"><a href="'.ROOT.'admin/?after='.$this_day_first.'&before='.date('Y-m-01', strtotime($this_day_first.'+1 month')).'" class="h0" data-delay="';
				if($rj7['sales_stat']['amount_this_month'] > 0){
					$delay++;
					echo $delay;
				}else{
					echo 0;
				};
				echo '" style="height:', $rj7['sales_stat']['amount_this_month']*$constant , 'px;"><span>'.number_format($rj7['sales_stat']['amount_this_month']).'円</span></a><span>';
				if($count == 10 || $this_month == 1){
					echo $this_yaer.'/';
				};
    		echo $this_month, '月</span></div>';
				$this_day_first = $date;
			};
		?>
    </div>
  </section>
  <footer>
  	<a href="http://admin.shop-pro.jp" target="_blank">カラーミーショップ管理画面</a>
  </footer>
</body>
</html>