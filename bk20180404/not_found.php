<?php
$filepath = __FILE__;
include './inc/site.php';
include ROOTDIR.'inc/head.php';
include ROOTDIR."inc/header.php";
?>

<h1><?php echo $title[$page] ?></h1>

<section>
	<h2>申し訳ございません<br>お探しのページが見つかりませんでした</h2>
  <p>お探しのページは削除されたか、名前が変更された可能性があります<br>
  直接アドレスを入力された場合は、アドレスが正しく入力されているかもう一度ご確認いただくか、下記リンクからお探しください</p>
</section>

<?php include ROOTDIR."inc/footer.php" ?>
