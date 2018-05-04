<?php
$filepath = __FILE__;
include './inc/site.php';
include ROOTDIR.'inc/head.php';
include ROOTDIR.'inc/header.php'
?>
<h1><?php echo $title[$page] ?></h1>

<form id="form" action="<?php echo ROOT ?>inc/check/" method="post">
	<!--<div class="selectArea">
    <select>
      <?php
			for($Y = 0; $Y < 2; $Y++){
	      echo '<option>',date('Y',strtotime('+'.$Y.' year')),'年</option>';
			}
      ?>
    </select>
  </div>
	<div class="selectArea">
    <select>
      <?php
			for($n = 0; $n < 12; $n++){
	      echo '<option';
				if($n+1 == date('n')){ echo ' selected'; };
				echo '>',$n+1,'月</option>';
			}
      ?>
    </select>
  </div>-->
	<div class="selectArea">
    <select name="year" class="jqy"></select>
  </div>
	<div class="selectArea">
  	<select name="month" class="jqm"></select>
  </div>
	<div class="selectArea">
    <select name="date" class="jqd"></select>
  </div>
  <input type="submit" name="submit" value="確認" />
</form>
<?php include ROOTDIR.'inc/footer.php' ?>

<script>
$(function(){
	var now = new Date(),
			this_m = now.getMonth() + 1,
			this_d = now.getDate(),
    	isSelected;
	for (var ny = 0; ny < 2; ny++) {
		var y = now.getFullYear() + ny;
    isSelected = (ny == 0);
		option = $('<option>', { value: y, text: y + '年', selected: isSelected });
		$('.jqy').append(option);
	};
	
	for (var nm = 1; nm < 13; nm++) {
    isSelected = (nm == this_m);
		option = $('<option>', { value: nm, text: nm + '月', selected: isSelected });
		$('.jqm').append(option);
	};

	function getMonthEndDay(year, month) { // 月の日数を計算
    var dt = new Date(year, month, 0);
    return dt.getDate();
	};
	function recal(last_day){ // 日付を再計算
		$('.jqd').empty();
		for (var nd = 1; nd < last_day + 1; nd++) {
			isSelected = (nd == this_d);
			option = $('<option>', { value: nd, text: nd + '日', selected: isSelected });
			$('.jqd').append(option);
		};
	};
	des_y = $('.jqy').val();
	des_m = $('.jqm').val();
	last_day = getMonthEndDay(des_y, des_m);
																														console.log(des_y);
																														console.log(des_m);
																														console.log(last_day);
	for (var nd = 1; nd < last_day + 1; nd++) { // 現在の月の日付を計算
    isSelected = (nd == this_d);
		option = $('<option>', { value: nd, text: nd + '日', selected: isSelected });
		$('.jqd').append(option);
	};

	$('.jqy').change(function() {
		des_y = $('.jqy').val();
		des_m = $('.jqm').val();
		last_day = getMonthEndDay(des_y, des_m);
																														console.log(des_y);
																														console.log(des_m);
																														console.log(last_day);
		recal(last_day);
	});
	$('.jqm').change(function() {
		des_y = $('.jqy').val();
		des_m = $('.jqm').val();
		last_day = getMonthEndDay(des_y, des_m);
																														console.log(des_y);
																														console.log(des_m);
																														console.log(last_day);
		recal(last_day);
	});

});
</script>

</body>
</html>
