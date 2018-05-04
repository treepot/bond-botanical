<?php
$filepath = __FILE__;
include './site.php';

session_start();
$_SESSION = $_POST;

if(!$_POST){
	header('Location: '.$_SERVER['HTTP_REFERER']);
}
include ROOTDIR.'inc/head.php';
include ROOTDIR.'inc/header.php';
?>
<h1><?php if($_POST['page_type'] == 'contact'){ echo 'Contact';}elseif($_POST['page_type'] == 'order'){ echo 'Order';} ?></h1>
<p>入力内容をご確認の上、よろしければ「送信」ボタンを押してください</p>
<?php if($_POST['page_type'] == 'contact'): ?>
<!--■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■ Contact ■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■-->
<form id="contact_confirm" action="<?php echo ROOT ?>inc/comp/" method="post">
  <input type="hidden" name="shopAdr" value="<?php echo $shopAdr ?>">
  <input type="hidden" name="sub_actions" value="confirm">
  <p>お問い合わせ内容</p>
  <div><?php echo htmlspecialchars($_POST['details']);?></div>
  <p>お名前</p>
  <div><?php echo htmlspecialchars($_POST['name']);?></div>
  <p>メールアドレス</p>
  <div><?php echo htmlspecialchars($_POST['email']);?></div>
  <p>詳細</p>
  <div class="comment"><?php
		$comment = htmlspecialchars($_POST['comment']);
		echo nl2br($comment);
	?></div>

<?php elseif($_POST['page_type'] == 'order'): ?>
<!--■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
■■ Order sheet ■■■■■■■■■■■■■■■■■■■■■■■■
■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■-->
<form id="order_confirm" action="<?php echo ROOT ?>inc/comp/" method="post">
  <input type="hidden" name="shopAdr" value="<?php echo $shopAdr ?>">
	<section>
		<h2>ご注文商品</h2>
    <div class="table">
      <dl>
        <dt>商品</dt>
        <dd><?php echo htmlspecialchars($_POST['flower_type']);?></dd>
        <dt>色</dt>
        <dd><?php echo htmlspecialchars($_POST['flower_color']);?></dd>
        <?php if(!empty($_POST['use_other']) || !empty($_POST['use'])): ?>
          <dt>用途</dt>
          <dd><?php if(!empty($_POST['use_other'])){ echo htmlspecialchars($_POST['use_other']); }else{ echo htmlspecialchars($_POST['use']); } ?></dd>
        <?php endif; ?>
        <dt>ご予算</dt>
        <dd><?php echo htmlspecialchars($_POST['budget']);?>円 (※送料・消費税を含みます)</dd>
      </dl>
    </div>
    <div class="table">
      <dl class="e1">
        <dt>メッセージカード</dt>
        <dd><?php
        if($_POST['card'] == 0){
          echo '不要';
        }elseif($_POST['card'] == 1){
          $card_text = htmlspecialchars($_POST['card_text']);
          echo nl2br($card_text);
        };
        ?></dd>
      </dl>
    </div>
    <div class="table">
      <dl class="<?php if($_POST['notice'] == 0){ echo 'e1';}else{ echo 'ttl';} ?>">
        <dt>立て札</dt>
      <?php if($_POST['notice'] == 0): ?>
        <dd>不要</dd>
      </dl>
      <?php elseif($_POST['notice'] == 1): ?>
        <dt>上書き</dt>
        <dd><?php if(!empty($_POST['notice_title_other'])){ echo htmlspecialchars($_POST['notice_title_other']); }else{ echo htmlspecialchars($_POST['notice_title']); } ?></dd>
      </dl>
      <dl>
        <h3>ご依頼主</h3>
        <dt>会社(店)名</dt>
        <dd><?php echo htmlspecialchars($_POST['notice_co_name_from']) ?></dd>
        <dt>役職名</dt>
        <dd><?php echo htmlspecialchars($_POST['notice_position_from']) ?></dd>
        <dt>お名前</dt>
        <dd><?php echo htmlspecialchars($_POST['notice_name_from']) ?></dd>
      </dl>
      <?php if(!empty($_POST['notice_co_name_to']) || !empty($_POST['notice_position_to']) || !empty($_POST['notice_name_to'])): ?>
      <dl>
        <h3>お届け先</h3>
      	<?php if(!empty($_POST['notice_co_name_to'])): ?>
          <dt>会社(店)名</dt>
          <dd><?php echo htmlspecialchars($_POST['notice_co_name_to']) ?></dd>
      	<?php endif;
				if(!empty($_POST['notice_position_to'])): ?>
          <dt>役職名</dt>
          <dd><?php echo htmlspecialchars($_POST['notice_position_to']) ?></dd>
      	<?php endif;
				if(!empty($_POST['notice_name_to'])): ?>
          <dt>お名前</dt>
          <dd><?php echo htmlspecialchars($_POST['notice_name_to']) ?></dd>
      	<?php endif; ?>
      </dl>
      <?php endif; ?>
      <?php endif; // notice ?>
    </div>
  </section>
  
	<section class="col2 clearfix">
		<h2>お届け先</h2>
    <div class="table">
      <dl>
        <dt>ご希望日時</dt>
        <dd><?php echo htmlspecialchars($_POST['year']), '年 ', htmlspecialchars($_POST['month']), '月 ', htmlspecialchars($_POST['date']), '日 ', htmlspecialchars($_POST['hour1']), '時〜', htmlspecialchars($_POST['hour2']), '時頃';?></dd>
      </dl>
      <dl>
      	<dt>お名前</dt>
        <dd><?php echo htmlspecialchars($_POST['name_to']) ?> <br class="sp">(<?php echo htmlspecialchars($_POST['furigana_to']) ?>)</dd>
      </dl>
      <dl>
      	<dt>電話番号</dt>
        <dd><?php echo htmlspecialchars($_POST['tel_to']) ?></dd>
      </dl>
    </div>
    <div class="table">
      <dl>
        <dt>郵便番号</dt>
        <dd><?php echo htmlspecialchars($_POST['zip_to']) ?></dd>
      </dl>
      <dl>
      	<dt>都道府県</dt>
        <dd><?php echo htmlspecialchars($_POST['pref_to']) ?></dd>
      </dl>
      <dl>
      	<dt>市区町村、番地</dt>
        <dd><?php echo htmlspecialchars($_POST['addr_to']) ?></dd>
      </dl>
      <dl>
      	<dt>マンション、ビル名等</dt>
        <dd><?php echo htmlspecialchars($_POST['room_no_to']) ?></dd>
      </dl>
    </div>
  </section>
  
	<section class="col2 clearfix">
		<h2>ご依頼主</h2>
    <div class="table">
      <dl>
      	<dt>お名前</dt>
        <dd><?php echo htmlspecialchars($_POST['name_from']) ?> <br class="sp">(<?php echo htmlspecialchars($_POST['furigana_from']) ?>)</dd>
      </dl>
      <dl>
      	<dt>電話番号</dt>
        <dd><?php echo htmlspecialchars($_POST['tel_from']) ?></dd>
      </dl>
      <?php if($_POST['PIC'] == 1): ?>
      <h3>ご担当者さま</h3>
      <dl>
      	<dt>名前</dt>
        <dd><?php echo htmlspecialchars($_POST['name_PIC']) ?> <br class="sp">(<?php echo htmlspecialchars($_POST['furigana_PIC']) ?>)</dd>
      </dl>
      <dl>
      	<dt>電話番号</dt>
        <dd><?php echo htmlspecialchars($_POST['tel_PIC']) ?></dd>
      </dl>
      <?php endif; ?>
      <dl>
      	<dt>メールアドレス</dt>
        <dd><?php echo htmlspecialchars($_POST['email']) ?></dd>
      </dl>
    </div>
    <div class="table">
      <dl>
        <dt>郵便番号</dt>
        <dd><?php echo htmlspecialchars($_POST['zip_from']) ?></dd>
      </dl>
      <dl>
      	<dt>都道府県</dt>
        <dd><?php echo htmlspecialchars($_POST['pref_from']) ?></dd>
      </dl>
      <dl>
      	<dt>市区町村、番地</dt>
        <dd><?php echo htmlspecialchars($_POST['addr_from']) ?></dd>
      </dl>
      <dl>
      	<dt>マンション、ビル名等</dt>
        <dd><?php echo htmlspecialchars($_POST['room_no_from']) ?></dd>
      </dl>
    </div>
  </section>
  
  <section>
		<h2>お支払い</h2>
    <div class="table">
      <dl>
        <dt>入金方法</dt>
        <dd><?php echo htmlspecialchars($_POST['transfer']);?></dd>
    		<?php if($_POST['transfer'] == '銀行振込'): ?>
        <dt>入金予定日</dt>
        <dd><?php echo htmlspecialchars($_POST['year_pay']), '年 ', htmlspecialchars($_POST['month_pay']), '月 ', htmlspecialchars($_POST['date_pay']), '日 ' ?></dd>
    		<?php endif; ?>
        <?php if(!empty($_POST['payer'])): ?>
        <dt>お振込名</dt>
        <dd><?php echo htmlspecialchars($_POST['payer']);?></dd>
        <?php endif; ?>
      </dl>
    </div>
    <?php if($_POST['transfer'] == '銀行振込'): ?>
    <div class="table">
      <dl>
      	<dt>振込先</dt>
        <dd>三井住友銀行　大阪中央支店　普通預金口座　NO.８４２０２３２</dd>
      </dl>
      <dl>
      	<dt>口座名</dt>
        <dd>㈱Bond</dd>
      </dl>
    </div>
    <?php endif; ?>
  </section>
  
  <?php if(!empty($_POST['detail_comments'])): ?>
  <section>
		<h2>その他</h2>
    <div class="table">
      <dl class="e1">
        <dt></dt>
        <dd><?php echo htmlspecialchars($_POST['detail_comments']);?></dd>
      </dl>
    </div>
  </section>
  <?php endif; ?>
<?php endif;  // page type ?>
  <a href="javascript:history.back();">
    <input type="button" value="< back">
  </a>
  <input type="submit" value="送信" name="submit">
</form>

<?php include ROOTDIR.'inc/footer.php' ?>