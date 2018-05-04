
<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta name="format-detection" content="telephone=no" />
<meta name="keywords" content="フラワーアレンジメントスクール,大阪,フラワーギフト,ウエディングフラワー,Wedding,<?php echo $title[$page] ?>">
<meta name="description" content="Bondは大阪市住吉区でフラワーギフト/ウエディングフラワーなどを販売してるお花屋(フラワーショップ)です。フラワーレッスンも開催しています。">
<title>bois de gui | <?php echo $title[$page] ?></title>
<!--<script src="<?php print ROOT ?>js/jquery.min.js"></script>-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="<?php print ROOT ?>js/common.js"></script>
<link rel="stylesheet" href="<?php print ROOT ?>css/sp.css">
<link rel="stylesheet" href="<?php print ROOT ?>css/pc.css">
<link rel="stylesheet" href="<?php print ROOT ?>css/common.css">
<link rel="stylesheet" href="<?php print ROOT ?>css/pad.css">
<link rel="stylesheet" href="<?php print ROOT ?>css/themify-icons.css"><!-- https://themify.me/themify-icons -->
<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<!--<script src="<?php print ROOT ?>js/jquery.inview.js"></script>--><!-- http://morobrand.net/mororeco/jquery/inview/ -->
<!--<link href="https://fonts.googleapis.com/css?family=Tangerine:700" rel="stylesheet"> 筆記体英字[没]-->
<link href="https://fonts.googleapis.com/css?family=Amiri|Open+Sans+Condensed:300" rel="stylesheet"><!-- Amiri：英字用。Open Sans Condensed：スマホ、タブレット時のメニューボタン -->
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous"><!-- http://fontawesome.io/icons/ -->

<?php
if($page_dir == 'top'){
	echo '<script src="',ROOT,'js/instafeed.min.js"></script>';//Instagram feed
};
if($page_dir == 'shop'){
	echo '<script src="http://maps.google.com/maps/api/js?key=AIzaSyDA9WV2vzhJM9dZRX0yK8hEaTYBAwQWHLE&sensor=true"></script>'; //google maps api
};
if($page_dir == 'wedding' || $page_dir == 'works'){
	echo '<link rel="stylesheet" href="',ROOT,'css/lightbox.min.css">'; //lightbox
};
if($page_dir == 'order_sheet'){
	echo '<script src="https://yubinbango.github.io/yubinbango/yubinbango.js" charset="UTF-8"></script>';// 郵便番号→住所変換
	//https://github.com/yubinbango/yubinbango
	/*echo '<script src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>'; 旧ver.*/
};
?>


<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-110987874-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-110987874-1');
</script>
<?php /*
■google Analytics account
[gmail] bond.web.management@gmail.com
[gmail pass] MPPxcFwxTVmy
*/ ?>

</head>

<body id="<?php echo $page_dir ?>" class="hide" <?php if($page_dir == 'shop'){ echo 'onload="initialize();"';} ?>>