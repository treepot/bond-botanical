<?php
$filepath = __FILE__;
include './inc/site.php';
include ROOTDIR.'inc/head.php';
?>
<?php include ROOTDIR.'inc/header.php' ?>
<h1><?php echo $title[$page] ?></h1>
<section class="shop">
  <h2><img src="<?php echo ROOT.'img/'.$logo_sp ?>" alt="<?php echo $logo_alt ?>"></h2>
  <address>〒541-0041　大阪市中央区北浜2－1－16　１F<br>
  
  京阪電車 北浜駅 3分<br>
  京阪電車　なにわ橋駅 7分<br>
  地下鉄御堂筋線　淀屋橋駅 5分<br>
  地下鉄堺筋線　北浜駅 3分</address>
  <p>TEL	<a href="tel:0662222287" class="sp">(06)6222-2287</a><span class="pc pad">(06)6222-2287</span>　　　　FAX	(06)6222-2387</p>
  <div class="map">
    <div id="bois_de_gui_map"></div>
  </div>
  <!--<h2>Atelier</h2>
  <p>万博迎賓館<br>Noble Wedding</p>-->
  <!--<address>〒565-0826 大阪府吹田市千里万博公園9−1</address>-->
</section>
<section class="company clearfix">
	<div class="pcleft">
    <h2>株式会社　Bond</h2>
    <table class="bond_info">
      <tr>
        <th>代表者</th>
        <td>宮川大作</td>
      </tr>
      <tr>
        <th>設立</th>
        <td>平成24年12月</td>
      </tr>
      <tr>
        <th>事業内容</th>
        <td>生花販売・観葉植物販売・店内装飾<br>ブライダル事業<br>グリーン事業</td>
      </tr>
      <tr>
        <th>住所</th>
        <td>〒541-0041<br>大阪市中央区北浜2－1－16　5F</td>
      </tr>
      <tr>
        <th>TEL</th>
        <td><a href="tel:0662283887" class="sp">(06)6228-3887</a><span class="pc pad">(06)6228-3887</span></td>
      </tr>
      <tr>
        <th>FAX</th>
        <td>(06)6228-3888</td>
      </tr>
    </table>
  </div>
  <div class="pc pcright"></div>
</section>

<?php include ROOTDIR.'inc/footer.php' ?>