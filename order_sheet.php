<?php
$filepath = __FILE__;
include './inc/site.php';
include ROOTDIR.'inc/head.php';
include ROOTDIR.'inc/header.php'
?>
<h1><?php echo $title[$page] ?></h1>
<div class="flow">
  <p>ご注文の流れ<span class="ti-angle-down sp"></span></p>
  <div class="flow_contents">
    <table>
      <tr>
        <th>①</th><td>オーダー内容を下記フォームにご入力の上、送信してください</td>
      </tr>
      <tr>
        <th>②</th><td>お送りいただいた内容をご確認の為、ご担当者様へ自動返信メールをお送りさせていただきます</td>
      </tr>
      <tr>
        <th>③</th><td>当社より24時間以内に受注完了メールもしくはお電話をさせていただきます<br>
        (ここで初めて受注完了となります　24時間以内に当社から連絡が無い場合は、<br>
        恐れ入りますが06-6222-2287までご連絡くださいませ)</td>
      </tr>
      <tr>
        <th>④</th><td>商品お届け</td>
      </tr>
      <tr>
        <th>⑤</th><td>お届けさせていただきましたお花のお写真を一週間以内にメールにてお送りさせていただきます<br>
        (お急ぎの方はご連絡くださいませ)</td>
      </tr>
    </table>
    <div class="btn_close sp">閉じる</div>
  </div>
</div>
<div class="err">
	<p class="flower_type_err">※商品の種類を選択してください</p>
	<p class="flower_color_err">※商品の色を選択してください</p>
	<p class="empty_err">※赤枠の必須項目にご入力ください</p>
  <p class="email_err">※確認用メールアドレスの入力内容をご確認ください</p>
  <p class="transfer_err">※ご入金方法を選択してください</p>
</div>
<form id="form" action="<?php echo ROOT ?>inc/check/" method="post" class="clearfix">
	<input type="hidden" name="page_type" value="order" />
  <h2>ご注文商品</h2>
  <div class="type">
  	<p>商品の種類</p>
    <input type="radio" name="flower_type" value="0"<?php if($_GET['flower_type'] == ''){ echo ' checked';} ?>>
    <input type="radio" name="flower_type" id="bouquet" value="花束"<?php if($_GET['flower_type'] == 'bouquet'){ echo ' checked';} ?>><!--
    --><label for="bouquet">花束</label><!--
    --><input type="radio" name="flower_type" id="arrangement" value="アレンジメント"<?php if($_GET['flower_type'] == 'arrangement'){ echo ' checked';} ?>><!--
    --><label for="arrangement">アレンジメント</label><!--
    --><input type="radio" name="flower_type" id="stand_flower" value="スタンド花"<?php if($_GET['flower_type'] == 'stand_flower'){ echo ' checked';} ?>><!--
    --><label for="stand_flower">スタンド花</label><!--
    --><input type="radio" name="flower_type" id="foliage_plants" value="観葉植物"<?php if($_GET['flower_type'] == 'foliage_plants'){ echo ' checked';} ?>><!--
    --><label for="foliage_plants">観葉植物</label><!--
    --><input type="radio" name="flower_type" id="orchid" value="コチョウラン"<?php if($_GET['flower_type'] == 'orchid'){ echo ' checked';} ?>><!--
    --><label for="orchid">コチョウラン</label><!--
    --><!--<input type="radio" name="flower_type" id="preserved" value="プリザーブド"<?php if($_GET['flower_type'] == 'preserved'){ echo ' checked';} ?>>--><!--
    --><!--<label for="preserved">プリザーブド</label>-->
  </div>
  <div class="color">
  	<p>色</p>
    <input type="radio" name="flower_color" value="0" checked>
    <input type="radio" name="flower_color" id="orchid_white" value="ホワイト"><!--
    --><label for="orchid_white">ホワイト</label><!--
    --><input type="radio" name="flower_color" id="white_green" value="白グリーン系"><!--
    --><label for="white_green">白グリーン系</label><!--
    --><input type="radio" name="flower_color" id="red" value="赤系"><!--
    --><label for="red">赤系</label><!--
    --><input type="radio" name="flower_color" id="yellow_orange" value="黄オレンジ系"><!--
    --><label for="yellow_orange">黄オレンジ系</label><!--
    --><input type="radio" name="flower_color" id="pink" value="ピンク系"><!--
    --><label for="pink">ピンク系</label><!--
    --><input type="radio" name="flower_color" id="purple" value="紫系"><!--
    --><label for="purple">紫系</label><!--
    --><input type="radio" name="flower_color" id="antique" value="アンティーク"><!--
    --><label for="antique">アンティーク</label><!--
    --><input type="radio" name="flower_color" id="count_on" value="おまかせ"><!--
    --><label for="count_on">おまかせ</label>
  </div>
  <div class="use">
  	<p>用途</p>
    <input type="radio" name="use" value="0" checked>
    <input type="radio" name="use" id="for_birthday" value="Birthday"><!--
    --><label for="for_birthday">Birthday</label><!--
    --><input type="radio" name="use" id="celebration" value="お祝い"><!--
    --><label for="celebration">お祝い</label><!--
    --><input type="radio" name="use" id="farewell" value="送別"><!--
    --><label for="farewell">送別</label><!--
    --><span class="other">その他：<input type="text" name="use_other"></span>
  </div>
  <div class="budget">
  	<p>ご予算<span>※送料・消費税を含みます</span></p>
    <input type="tel" name="budget" class="required"><span>円</span>
  </div>
  <div class="card">
  	<div class="swich">
      <input type="hidden" name="card" value="0">
      <input type="checkbox" id="card" name="card" value="1">
      <label for="card">メッセージカードを追加する</label>
    </div>
    <div class="card_contents">
      <p>メッセージ内容</p>
      <textarea name="card_text"></textarea>
    </div>
  </div>
  <div class="notice">
  	<div class="swich">
      <input type="hidden" name="notice" value="0">
      <input type="checkbox" id="notice" name="notice" value="1">
      <label for="notice">立て札を追加する</label>
    </div>
    <div class="notice_contents">
      <div class="notice_title">
        <p>上書き</p>
        <input type="radio" name="notice_title" id="oiwai" value="御祝"><!--
        --><label for="oiwai">御祝</label><!--
        --><input type="radio" name="notice_title" id="kaiten" value="祝開店"><!--
        --><label for="kaiten">祝開店</label><!--
        --><input type="radio" name="notice_title" id="open" value="祝OPEN"><!--
        --><label for="open">祝OPEN</label><!--
        --><input type="radio" name="notice_title" id="congratulations" value="Congratulations!!"><!--
        --><label for="congratulations">Congratulations!!</label><!--
        --><span class="other">その他：<input type="text" name="notice_title_other"></span>
      </div>
      <div class="notice_from_to clearfix">
        <h3>ご依頼主</h3>
        <div class="notice_co_name">
          <p>会社(店)名</p>
          <input type="text" name="notice_co_name_from">
        </div>
        <div class="notice_position">
          <p>役職名</p>
          <input type="text" name="notice_position_from">
        </div>
        <div class="notice_name">
          <p>お名前</p>
          <input type="text" name="notice_name_from">
        </div>
      </div><!-- /.notice_from_to -->
      <div class="notice_from_to clearfix">
        <h3>お届け先 <span>(お届け先は必要な場合のみご入力ください)</span></h3>
        <div class="notice_co_name">
          <p>会社(店)名</p>
          <input type="text" name="notice_co_name_to">
        </div>
        <div class="notice_position">
          <p>役職名</p>
          <input type="text" name="notice_position_to">
        </div>
        <div class="notice_name">
          <p>お名前</p>
          <input type="text" name="notice_name_to">
        </div>
      </div><!-- /.notice_from_to -->
    </div><!-- /.notice_contents -->
  </div><!-- /.notice -->

	<h2>お届け先</h2>

  <div class="delivery_info clearfix">
    <div class="delivery_date clearfix">
      <p>ご希望日時</p>
      <div class="selectArea year">
        <select name="year"></select>
      </div>
      <div class="selectArea month">
        <select name="month"></select>
      </div>
      <div class="selectArea date">
        <select name="date"></select>
      </div>
      <div class="selectArea hour1">
        <select name="hour1">
          <?php
            for ($h = 9; $h <= 19; $h++){
              echo '<option value="',$h,'"';
              if($h == 12){
                echo ' selected';
              };
              echo '>',$h,':00</option>';
            };
          ?>
        </select>
      </div>
      <span>〜</span>
      <div class="selectArea hour2">
        <select name="hour2">
          <?php
            for ($h = 10; $h <= 20; $h++){
              echo '<option value="',$h,'"';
              if($h == 13){
                echo ' selected';
              };
              echo '>',$h,':00</option>';
            };
          ?>
        </select>
      </div>
    </div>
    <div class="name mr mrpad">
      <p>お名前</p>
      <input type="text" name="name_to" placeholder="お名前を入力" class="required">
    </div>
    <div class="furigana">
      <p>ふりがな</p>
      <input type="text" name="furigana_to" placeholder="ふりがなを入力" class="required">
    </div>
    <div class="tel">
      <p>電話番号<span>例 : 06-0000-0000</span></p>
      <input type="text" name="tel_to" placeholder="電話番号(半角)を入力" class="required">
    </div>
  </div>
	<div class="delivery_info h-adr clearfix">
  	<span class="p-country-name" style="display:none;">Japan</span>
  	<div class="code mrpad">
      <p>郵便番号<span class="pc sp">例 : 000-0000</span><span class="auto_input">住所自動入力</span></p>
      <input type="text" name="zip_to" class="p-postal-code required" size="8" maxlength="8" placeholder="郵便番号(半角)を入力">
      <!--<input type="text" name="zip01" maxlength="8" onKeyUp="AjaxZip3.zip2addr(this,'','pref01','addr01');" placeholder="郵便番号(半角)を入力">-->
    </div>
    <div class="pref mr">
      <p>都道府県</p>
      <input type="text" name="pref_to" placeholder="都道府県を入力" class="p-region required">
    </div>
    <div class="addr1">
      <p>市区町村、番地</p>
      <input type="text" name="addr_to" placeholder="市区町村、番地を入力" class="p-locality p-street-address p-extended-address required">
    </div>
    <div class="addr2">
      <p>マンション、ビル名等</p>
      <input type="text" name="room_no_to" placeholder="マンション、ビル名等を入力">
    </div>
  </div>

	<h2>ご依頼主</h2>

  <div class="delivery_info clearfix">
    <div class="name mr mrpad">
      <p>お名前</p>
      <input type="text" name="name_from" placeholder="お名前を入力" class="required">
    </div>
    <div class="furigana">
      <p>ふりがな</p>
      <input type="text" name="furigana_from" placeholder="ふりがなを入力" class="required">
    </div>
    <div class="tel">
      <p>電話番号<span>例 : 06-0000-0000</span></p>
      <input type="text" name="tel_from" placeholder="電話番号(半角)を入力" class="required">
    </div>
  	<div class="swich">
      <input type="hidden" name="PIC" value="0">
      <input type="checkbox" id="PIC" name="PIC" value="1">
      <label for="PIC">ご依頼主とご担当者さまが異なる</label>
    </div>
    <div class="PIC">
      <h3>ご担当者さま</h3>
      <div class="name mr mrpad">
        <p>お名前</p>
        <input type="text" name="name_PIC" placeholder="お名前を入力">
      </div>
      <div class="furigana">
        <p>ふりがな</p>
        <input type="text" name="furigana_PIC" placeholder="ふりがなを入力">
      </div>
      <div class="tel">
        <p>電話番号<span>例 : 06-0000-0000</span></p>
        <input type="text" name="tel_PIC" placeholder="電話番号(半角)を入力">
      </div>
    </div><!-- /.PIC -->
    <div class="mail">
      <p>メールアドレス</p>
      <input type="text" name="email" placeholder="メールアドレス(半角)を入力" class="required">
    </div>
    <div class="mail">
      <p>メールアドレス確認</p>
      <input type="text" name="email_comf" placeholder="メールアドレス(半角)を入力">
    </div>
  </div><!-- /.delivery_info -->
	<div class="delivery_info h-adr clearfix">
  	<span class="p-country-name" style="display:none;">Japan</span>
  	<div class="code mrpad">
      <p>郵便番号<span class="pc sp">例 : 000-0000</span><span class="auto_input">住所自動入力</span></p>
      <input type="text" name="zip_from" class="p-postal-code required" size="8" maxlength="8" placeholder="郵便番号(半角)を入力">
    </div>
    <div class="pref mr">
      <p>都道府県</p>
      <input type="text" name="pref_from" placeholder="都道府県を入力" class="p-region required">
    </div>
    <div class="addr1">
      <p>市区町村、番地</p>
      <input type="text" name="addr_from" placeholder="市区町村、番地を入力" class="p-locality p-street-address p-extended-address required">
    </div>
    <div class="addr2">
      <p>マンション、ビル名等</p>
      <input type="text" name="room_no_from" placeholder="マンション、ビル名等を入力">
    </div>
  </div><!-- /.delivery_info -->

	<h2>お支払い</h2>

  <div class="payment clearfix">
  	<div class="transfer">
    	<p>入金方法</p>
    	<input type="radio" name="transfer" value="0" checked>
      <input type="radio" name="transfer" id="bank_transfer" value="銀行振込" class="required"><!--
      --><label for="bank_transfer">銀行振込</label><!--
      --><input type="radio" name="transfer" id="paypal" value="PayPal" class="required"><!--
      --><label for="paypal">PayPal</label>
    </div>
    <div class="deposit_date clearfix">
    	<p>入金予定日</p>
      <div class="selectArea year_pay">
        <select name="year_pay"></select>
      </div>
      <div class="selectArea month_pay">
        <select name="month_pay"></select>
      </div>
      <div class="selectArea date_pay">
        <select name="date_pay"></select>
      </div>
    </div>
    <div class="payer">
      <p>お振込名<span> (ご依頼主様名とお振込名が異なる場合のみご記入ください)</span></p>
      <input type="text" name="payer">
    </div>
  </div><!-- /.payment -->

  <h2>その他</h2>

  <div class="comments">
  	<div class="detail_comments">
    	<p>より詳しいご指定等ございましたらご記入ください</p>
      <textarea name="detail_comments"></textarea>
    </div>
  </div>

  <input type="submit" name="submit" value="確認" />
</form>
<?php include ROOTDIR.'inc/footer.php' ?>

<script>
$(function(){
	var now = new Date(),
			this_m = now.getMonth() + 1,
			this_d = now.getDate(),
			this_w = now.getDay(),
			wd = ["日", "月", "火", "水", "木", "金", "土"],
    	isSelected,
			$year = $('.year').children('select'),
			$month = $('.month').children('select'),
			$date = $('.date').children('select');
			$year_pay = $('.year_pay').children('select'),
			$month_pay = $('.month_pay').children('select'),
			$date_pay = $('.date_pay').children('select');

	for (var ny = 0; ny < 2; ny++) { // 年selectには今年と来年の2つのoptionを表示
		var y = now.getFullYear() + ny;
    isSelected = (ny == 0);
		option = $('<option>', { value: y, text: y + '年', selected: isSelected });
		$year.each(function() {
      $(this).append(option);
    });
	};

	for (var nm = 1; nm < 13; nm++) { // 月select
    isSelected = (nm == this_m);
		option = $('<option>', { value: nm, text: nm + '月', selected: isSelected });
		$month.append(option);
	};

	for (var ny = 0; ny < 2; ny++) { // 年select 支払い日選択用
		var y = now.getFullYear() + ny;
    isSelected = (ny == 0);
		option = $('<option>', { value: y, text: y + '年', selected: isSelected });
		$year_pay.each(function() {
      $(this).append(option);
    });
	};
	for (var nm = 1; nm < 13; nm++) { // 月select 支払い日選択用
    isSelected = (nm == this_m);
		option = $('<option>', { value: nm, text: nm + '月', selected: isSelected });
		$month_pay.append(option);
	};

	function getMonthEndDay(year, month) { // 指定した月の日数(月末日)を計算
    var dt = new Date(year, month, 0);
    return dt.getDate();
	};
	function recal(last_day, des_y, des_m, des_d){ // 日付を再構築
		$date.empty(); // 日付selectに入っているoptionを削除
		for (var nd = 1; nd < last_day + 1; nd++) {
			week = wd[new Date(des_y,des_m-1,nd).getDay()];
			isSelected = (nd == des_d);
			option = $('<option>', { value: nd, text: nd + '日 (' + week + ')', selected: isSelected });
			$date.append(option);
		};
	};

	/* 日付の初期状態を現在日時から計算 */
	des_y = $year.val();
	des_m = $month.val();
	last_day = getMonthEndDay(des_y, des_m);
	for (var nd = 1; nd < last_day + 1; nd++) {
		week = wd[new Date(des_y,des_m-1,nd).getDay()];
    isSelected = (nd == this_d);
		option = $('<option>', { value: nd, text: nd + '日 (' + week + ')', selected: isSelected });
		$date.append(option);
	};

	/* 年月が変更された場合に日付を再計算 */
	$year.change(function() {
		des_y = $year.val();
		des_m = $month.val();
		des_d = $date.val();
		last_day = getMonthEndDay(des_y, des_m);
		recal(last_day, des_y, des_m, des_d);
	});
	$month.change(function() {
		des_y = $year.val();
		des_m = $month.val();
		des_d = $date.val();
		last_day = getMonthEndDay(des_y, des_m);
		recal(last_day, des_y, des_m, des_d);
	});

/* 日付の初期状態を現在日時から計算 支払い日選択用 */
	des_y = $year_pay.val();
	des_m = $month_pay.val();
	last_day = getMonthEndDay(des_y, des_m);
	for (var nd = 1; nd < last_day + 1; nd++) {
		week = wd[new Date(des_y,des_m-1,nd).getDay()];
    isSelected = (nd == this_d);
		option = $('<option>', { value: nd, text: nd + '日 (' + week + ')', selected: isSelected });
		$date_pay.append(option);
	};

	/* 年月が変更された場合に日付を再計算 支払い日選択用 */
	$year_pay.change(function() {
		des_y = $year_pay.val();
		des_m = $month_pay.val();
		des_d = $date_pay.val();
		last_day = getMonthEndDay(des_y, des_m);
		recal(last_day, des_y, des_m, des_d);
	});
	$month_pay.change(function() {
		des_y = $year_pay.val();
		des_m = $month_pay.val();
		des_d = $date_pay.val();
		last_day = getMonthEndDay(des_y, des_m);
		recal(last_day, des_y, des_m, des_d);
	});

	/* カラー制御 */
	if($('input#foliage_plants').is(':checked')) {// 観葉植物選択
		$('#form>.color>label').show();
		$('#form>.color>input:not(#count_on)').next('label').hide();
		$('#form>.color>input#count_on').prop('checked', true);
	}else if($('input#orchid').is(':checked')){// 胡蝶蘭選択
		$('#form>.color>label').show();
		$('#form>.color>input:not(#orchid_white)').next('label').hide();
		$('#form>.color>input#orchid_white').prop('checked', true);
	}else{
		$('#form>.color>label').show();
		$('#form>.color>input#orchid_white').next('label').hide();
		$('#form>.color>input#orchid_white').prop('checked', false);
	};
	$('input[name="flower_type"]').change(function() {
		if($('input#foliage_plants').is(':checked')) {
			$('#form>.color>label').show();
			$('#form>.color>input:not(#count_on)').next('label').hide();
			$('#form>.color>input#count_on').prop('checked', true);
		}else if($('input#orchid').is(':checked')){
			$('#form>.color>label').show();
			$('#form>.color>input:not(#orchid_white)').next('label').hide();
			$('#form>.color>input#orchid_white').prop('checked', true);
		}else{
			$('#form>.color>label').show();
			$('#form>.color>input#orchid_white').next('label').hide();
			$('#form>.color>input#orchid_white').prop('checked', false);
		};
	});

	/* 用途ラジオの「その他」選択時に他のチェックを解除 */
	$('.use').children('span.other').click(function(){
		$('.use').children('input[name="use"]').each(function() {
			$(this).prop('checked', false);
		});
	});
	$('.notice_title').children('span.other').click(function(){
		$('.notice_title').children('input[name="notice_title"]').each(function() {
			$(this).prop('checked', false);
		});
	});

	/* メッセージカードチェックの場合開く */
	if($('input#card').is(':checked')) {
		$('#form>.card>.card_contents').show();
		$('#form>.card>.card_contents>textarea').addClass('required');
	}else{
		$('#form>.card>.card_contents').hide();
		$('#form>.card>.card_contents>textarea').removeClass('required');
	};
	$('input#card').change(function() {
		if($('input#card').is(':checked')) {
			$('#form>.card>.card_contents').slideDown();
		$('#form>.card>.card_contents>textarea').addClass('required');
		}else{
			$('#form>.card>.card_contents').slideUp();
		$('#form>.card>.card_contents>textarea').removeClass('required');
		};
	});
	/* 立て札チェックの場合開く */
	if($('input#notice').is(':checked')) {
		$('#form>.notice>.notice_contents').show();
		$('#form>.notice>.notice_contents>.notice_from_to:not(:last-child)').find('input').addClass('required');
	}else{
		$('#form>.notice>.notice_contents').hide();
		$('#form>.notice>.notice_contents>.notice_from_to:not(:last-child)').find('input').removeClass('required');
	};
	$('input#notice').change(function() {
		if($('input#notice').is(':checked')) {
			$('#form>.notice>.notice_contents').slideDown();
		$('#form>.notice>.notice_contents>.notice_from_to:not(:last-child)').find('input').addClass('required');
		}else{
			$('#form>.notice>.notice_contents').slideUp();
		$('#form>.notice>.notice_contents>.notice_from_to:not(:last-child)').find('input').removeClass('required');
		};
	});
	/* 担当者チェックの場合開く */
	if($('input#PIC').is(':checked')) {
		$('#form>.delivery_info>.PIC').show();
	}else{
		$('#form>.delivery_info>.PIC').hide();
	};
	$('input#PIC').change(function() {
		if($('input#PIC').is(':checked')) {
			$('#form>.delivery_info>.PIC').slideDown();
		}else{
			$('#form>.delivery_info>.PIC').slideUp();
		};
	});

	/* PayPal選択時入金日欄消す */
	if($('input#paypal').is(':checked')) {
		$('#form>.payment>.deposit_date').hide();
	}else{
		$('#form>.payment>.deposit_date').show();
	};
	$('input[name="transfer"]').change(function() {
		if($('input#paypal').is(':checked')) {
			$('#form>.payment>.deposit_date').hide();
		}else{
			$('#form>.payment>.deposit_date').show();
		};
	});

	/* sp 流れ開閉 */
	var ww = $(window).width();
	if(ww <= 767){
		$('#order_sheet>.flow>p').click(function(){
			$(this).next('.flow_contents').stop().slideToggle();
			$(this).children('span').toggleClass('close');
		});
		$('#order_sheet>.flow>.flow_contents>.btn_close').click(function(){
			$('#order_sheet>.flow>.flow_contents').slideUp();
			$('#order_sheet>.flow>p>span').removeClass('close');
		});
	}
});
</script>
