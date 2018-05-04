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
$defcount = 6;//通常の大きさの写真の連続個数初期値
$pics = 42;//写真枚数
for($n = 1; $n < $pics + 1; $n++){
	$floatstyle = '';
	$bigclass = '';
	$imgsize = getimagesize( ROOTDIR.'img/wedding/wedding'.$n.'.jpg' );
	$AR = $imgsize[1]/$imgsize[0];
	$roundAR = round($AR, 1);
	if($defcount > 6 && $n < $pics - 3){//大きな写真の間隔を7枚あける。& 最後から3枚は大きくしない
		if($roundAR == 1){
			$bigclass = ' row2col2';
			if($bigcount %2 == 0){
				$floatstyle = 'float:left;';
			}else{
				$floatstyle = 'float:right;';
			}
			$bigcount++;
			$defcount = 0;
		}elseif($roundAR >= 1.5){
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
	echo '<a href="', ROOT, 'img/wedding/wedding', $n,'.jpg" class="image-link ap', $bigclass,'" data-lightbox="photo" data-ar="', $roundAR, '" style="background-image:url(', ROOT, 'img/wedding/wedding', $n,'.jpg);', $floatstyle,'" data-defcount="', $defcount,'"></a>';
}
?>
  <div class="text">
    <p>bois de guiでは、ウェディングブーケ、ブートニア、ヘアパーツはもちろん、挙式会場、パーティー会場の装飾も承っております</p>
    
    <h2 class="ul">How to order</h2>
    <p>会場、ドレスなどが決まりましたら、3ヶ月前から1ヶ月前までにお打ち合わせさせていただきます</p>
    <p>会場によってはお持ち込みが出来ない場合がございます<br>事前にご確認いただき、ご予約ください</p>
    <div class="price_table amiri">
      <span>price</span>
      <table>
        <tr>
          <th>bouquet</th><td>¥30,000～</td>
        </tr>
        <tr>
          <th>haired</th><td>¥5,000～</td>
        </tr>
        <tr>
          <th>main table</th><td>¥50,000～</td>
        </tr>
        <tr>
          <th>guest table</th><td>¥5,000～</td>
        </tr>
      </table>
    </div>
    <p>その他のフラワーアイテム(花かんむり、リストレット、贈呈用花束、受付装花、etc)もお作りいたします</p>
    <p>急なご来店でのお打ち合わせは、お店の状況により、応対出来かねる場合がございますので、まずはお電話かメールにてご相談ください</p>
  </div>
</section>
 
<?php include ROOTDIR.'inc/footer.php' ?>

<script src="<?php print ROOT ?>js/lightbox.min.js"></script><!--lightbox-->
<script>
$(function(){
	$('.image-link').viewbox();
});
</script>