<?php
$dirname = __FILE__;
include "./inc/site.php";
include "./inc/head.php"
?>
<script type="text/javascript">
var feed = new Instafeed({
    clientId: '93453d0cb7454313a327d2dc733dc68e',
    get: 'user', 
    userId: '2067113655',
    accessToken:'2067113655.93453d0.8f13bdf156d447cca9fdccaf79b41e21',
    links: true,
    limit: 18, // 取得件数 
    resolution:'low_resolution', // thumbnail (default) - 150x150 | low_resolution - 306x306 | standard_resolution - 612x612
    template: '<a href="{{link}}" style="background-image:url({{image}});" target="_blank"></a>' // 画像URL：{{image}} リンク：{{link}} キャプションテキスト{{caption}} いいね数：{{likes}} コメント数：{{comments}}
});
feed.run();
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.10";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<section class="mv">
  <h1 style="display:none;"><img src="<?php echo($root.'img/bois-de-gui-logo_white.png" alt="'.$logo_alt) ?>"><!--<a class="pc" href="#header" data-scroll></a>--></h1>
  <div class="slider">
    <?php foreach($mv as $slider){echo '<div class="slide zoom" style="background-image: url(img/'.$slider.'); display:none;z-index:10;"></div>';} ?>
  </div>
</section>
<?php include $root."inc/header.php" ?>
<section id="s2">
  <div class="p">
    <dl>
      <dt><img src="<?php echo $root.'img/bois-de-gui-logo_white.png" alt="'.$logo_alt ?>" /></dt>
      <dd>"ボワドゥギ"と読みます<br>「ヤドリギの森」という意味です</dd>
    
      <dt>：ヤドリギ</dt>
      <dd>欧米では木々が落葉する冬でも<br>青々とする葉をつけているので、<br>
      生命や不死を表すシンボルとされています<br><br>
      そのような神秘的な力から<br class="sp"><span class="pc pad">、</span>ヤドリギの下では争いをしてはいけない<br class="sp">ともいわれており、<br>
      また冬の寒さから逃げた妖精が住んでいる<br>ともいわれています</dd>
    </dl>
  </div>
  <div class="img pc"></div>
</section>

<!--<section id="fb_plugin">
<div class="fb-page pc" data-href="https://www.facebook.com/bois-de-gui-398269033614623/" data-tabs="timeline" data-width="500" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/bois-de-gui-398269033614623/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bois-de-gui-398269033614623/">bois de gui</a></blockquote></div>
<div class="pc pad"><img src="<?php echo $root ?>img/fb_logo.png"</div>
</section>-->

<section id="gallery">
  <h2 class="ul">Gallery</h2>
  <div id="instafeed"></div>
	<!--<script src="https://snapwidget.com/js/snapwidget.js"></script>
  <a class="pc pad" href="https://www.instagram.com/boisdegui/" target="_blank"></a>
  <iframe src="https://snapwidget.com/embed/434830" class="snapwidget-widget pc pad" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>
  <a class="sp" href="https://www.instagram.com/boisdegui/" target="_blank"></a>
  <iframe src="https://snapwidget.com/embed/434832" class="snapwidget-widget sp" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>-->
</section>
<?php include $root."inc/footer.php" ?>