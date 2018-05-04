<?php
$filepath = __FILE__;
include './inc/site.php';
include ROOTDIR.'inc/head.php';
include ROOTDIR.'inc/header.php'
?>
<h1><?php echo $title[$page] ?></h1>
<form id="form" action="<?php echo ROOT ?>inc/check/" method="post">
	<input type="hidden" name="page_type" value="contact">
	<p>お問い合わせ内容</p>
  <div class="selectArea">
    <select name="details">
      <option value="0">選択してください</option>
      <option value="商品について">商品について</option>
      <option value="レッスンへのお申し込み">レッスンへのお申し込み</option>
      <option value="ブライダルについて">ブライダルについて</option>
      <option value="求人のご応募">求人のご応募</option>
      <option value="その他">その他</option>
    </select>
    <span>選択してください</span>
  </div>
  <p>お名前</p>
	<input type="text" name="name" required="required">
  <p>メールアドレス</p>
  <input type="email" name="email" required="required">
  <p>詳細</p>
  <textarea name="comment" required="required"></textarea>
  <input type="submit" name="submit" value="確認">
</form>
<?php include ROOTDIR.'inc/footer.php' ?>
