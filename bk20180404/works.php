<?php
$filepath = __FILE__;
include './inc/site.php';
include ROOTDIR.'inc/head.php';
?>
<?php include ROOTDIR.'inc/header.php' ?>

<h1><?php echo $title[$page] ?></h1>
<section class="gallery">

<?php
$bigcount = 0;//大きく表示する写真のカウント
$defcount = 7;//通常の大きさの写真の連続個数の初期値
$pics = 27;//写真枚数

for($n = 1; $n < $pics + 1; $n++){
	$floatstyle = '';
	$bigclass = '';
	$imgsize = getimagesize( ROOTDIR.'img/works/works'.$n.'.jpg' );// 画像サイズ取得
	$AR = $imgsize[1]/$imgsize[0];// アスペクト比(AR)
	$roundAR = round($AR, 1);// ARを小数点1位までに四捨五入
	
	if($defcount >= 7 && $n < $pics - 7){//大きな写真の間隔を6枚あける。& 最後から7枚は大きくしない
		if($roundAR >= 0.8 && $roundAR <= 1.2){
			$bigclass = ' row2col2';
			if($bigcount %2 == 0){
				$floatstyle = 'float:left;';
			}else{
				$floatstyle = 'float:right;';
			}
			$bigcount++;
			$defcount = 0;
		}elseif($roundAR >= 1.3){
			$bigclass = ' row3col2';
			if($bigcount %2 == 0){
				$floatstyle = 'float:left;';
			}else{
				$floatstyle = 'float:right;';
			}
			$bigcount++;
			$defcount = 0;
		}elseif($roundAR <= 0.7){
			$bigclass = ' row2col3';
			if($bigcount %2 == 0){
				$floatstyle = 'float:left;';
			}else{
				$floatstyle = 'float:right;';
			}
			$bigcount++;
			$defcount = 0;
		}else{
			$defcount++;
		};
	}else{
		$defcount++;
	};
	echo '<a href="', ROOT, 'img/works/works', $n,'.jpg" class="image-link ap', $bigclass,'" data-lightbox="photo" data-ar="', $roundAR, '" style="background-image:url(', ROOT, 'img/works/works', $n,'.jpg);', $floatstyle,'" data-defcount="', $defcount,'"></a>';
 }
?>
  <div class="text">
    <p>ショップディスプレイ、定期装花、広告撮影、展示会等のお花も承っております</p>
  </div>
</section>
 
<?php include ROOTDIR.'inc/footer.php' ?>

<script src="<?php print ROOT ?>js/lightbox.min.js"></script><!--lightbox-->
<script>
$(function(){
	$('.image-link').viewbox();
});
</script>