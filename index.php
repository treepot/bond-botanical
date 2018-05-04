<?php
$dirname = __FILE__;
include "./inc/site.php";
include "./inc/head.php";
?>
<script>
$(function(){
  if(hash = $(location).attr('hash')){
    if ( hash.match(/access_token/)) {
      hash = hash.replace("#", "");
      window.location.href = '<?php echo ROOT ?>admin/setting/?'+hash;
    }
  }
});
</script>
<?php
$db_table = 'setting';
//sqLite
$data = array();
if(!empty($db_table)){
  // Initialize
  $db = null;
  $sql = null;
  $res = null;

  // データベースへ接続
  $db = new SQLite3("./admin/bond.sqlite");

  // データの取得
  $sql = 'SELECT * FROM '.$db_table;
  $res = $db->query($sql);
  while( $row = $res->fetchArray() ) {
    array_push($data, $row);
  }
}

if($debug == 1 && !empty($db_table)){
  echo '<!--<pre>';
  var_dump($data);
  echo '</pre>-->';
}
?>
<script type="text/javascript">
var feed = new Instafeed({
    clientId: '93453d0cb7454313a327d2dc733dc68e',
    get: 'user',
    userId: '2067113655',
    accessToken: '<?php echo $data[1]['instagram_token'] ?>',
  //accessToken:'2067113655.93453d0.8f13bdf156d447cca9fdccaf79b41e21',//2018,4,3再取得のため破棄
    links: true,
    limit: 18, // 取得件数
    resolution:'low_resolution', // thumbnail (default) - 150x150 | low_resolution - 306x306 | standard_resolution - 612x612
    template: '<a href="{{link}}" style="background-image:url({{image}});" target="_blank"></a>' // 画像URL：{{image}} リンク：{{link}} キャプションテキスト{{caption}} いいね数：{{likes}} コメント数：{{comments}}
});
/*
アクセストークン再取得方法
1. 下記にアクセス
https://instagram.com/oauth/authorize/?client_id=93453d0cb7454313a327d2dc733dc68e&redirect_uri=http://bond-botanical.jp&response_type=token
2. ログイン画面が出たらInstagramアカウントでログイン（未ログインの場合）
3.「This app is in sandbox mode and can only be authorized by sandbox users.」という画面が出たら、右下の「Authorize」をクリック
4. boisdeguiサイトにリダイレクトするのでurlの「#access_token=＊＊＊＊」をコピー

他登録情報が必要な場合は下記参照
https://www.instagram.com/developer/clients/manage/

参考doc. https://www.instagram.com/developer/authentication/
*/
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
  <h1 style="display:none;"><img src="<?php echo(ROOT.'img/bois-de-gui-logo_white.png" alt="'.$logo_alt) ?>"><!--<a class="pc" href="#header" data-scroll></a>--></h1>
  <div class="slider">
    <?php foreach($mv as $slider){echo '<div class="slide zoom" style="background-image: url(img/'.$slider.'); display:none;z-index:10;"></div>';} ?>
  </div>
</section>
<?php include ROOTDIR."inc/header.php" ?>
<section id="s2">
  <div class="p">
    <dl>
      <dt><img src="<?php echo ROOT.'img/bois-de-gui-logo_white.png" alt="'.$logo_alt ?>" /></dt>
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

<?php if($season_open == 1){ ?>
<section id="season_bnr">
  <a href="./order/">
    <img class="pc pad" src="./img/season/bnr_2018_mothersday.jpg" alt="2018.5.13 Mother's Day 母の日 bois de gui">
    <img class="sp" src="./img/season/bnr_2018_mothersday_sp.jpg" alt="2018.5.13 Mother's Day 母の日 bois de gui">
  </a>
</section>
<?php } ?>

<section id="gallery">
  <h2 class="ul">Gallery</h2>
  <div id="instafeed"></div>
	<!--<script src="https://snapwidget.com/js/snapwidget.js"></script>
  <a class="pc pad" href="https://www.instagram.com/boisdegui/" target="_blank"></a>
  <iframe src="https://snapwidget.com/embed/434830" class="snapwidget-widget pc pad" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>
  <a class="sp" href="https://www.instagram.com/boisdegui/" target="_blank"></a>
  <iframe src="https://snapwidget.com/embed/434832" class="snapwidget-widget sp" allowTransparency="true" frameborder="0" scrolling="no" style="border:none; overflow:hidden; width:100%; "></iframe>-->
</section>
<?php include ROOTDIR."inc/footer.php" ?>
