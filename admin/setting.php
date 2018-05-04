<?php
include '../inc/site.php';

//sqliteテーブル
// if($_COOKIE['login'] != 1){//ログインしていない場合ログイン画面へ遷移
//   header('Location: ./login.php');
//   exit();
// }else{
//   if($_COOKIE['login'] == 1){
//     echo '<!-- login -->';
//   }else{
//     echo '<!-- logout -->';
//   };
//   if(isset($_GET['page'])){
//     $db_table = $_GET['page'];
//   }else{//設定画面ホーム
//     $db_table = '';
//   }
// }

$db_table = 'setting';

if(isset($_GET['access_token'])){
  // Initialize
  $db = null;
  $sql = null;
  $res = null;
  // データベースへ接続
  $db = new SQLite3("./bond.sqlite");
  //トークンの更新
  $key = 'instagram_token';
  $sql = 'UPDATE '.$db_table.' SET '.$key.'= "'.$_GET['access_token'].'" WHERE id = 2';
  $res = $db->query($sql);
  //更新日時の更新
  $key = 'uptime';
  $now = date('Y/m/d H:i:s');//更新時刻
  $sql = 'UPDATE '.$db_table.' SET '.$key.'= "'.$now.'" WHERE id = 2';
  $res = $db->query($sql);
}

//パラメータ
$param = array();
if($debug == 1){
  $param = array_merge($param, array('mode' => 'debug'));
}
if(!empty($db_table)){
  $param = array_merge($param, array('page' => $db_table));
}
$get = http_build_query($param);

//更新ボタン
if(isset($_GET['update'])){
  if($_GET['update'] == 'true'){
    $btn_class = ' btn-success';
  }else if($_GET['update'] == 'false'){
    $btn_class = ' btn-error';
  }
}else{
  $btn_class = '';
}

//sqLite
$data = array();
if(!empty($db_table)){
  // Initialize
  $db = null;
  $sql = null;
  $res = null;

  // データベースへ接続
  $db = new SQLite3("./bond.sqlite");

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
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <title>bois de gui | 設定</title>
  <link rel="stylesheet" href="<?php echo ROOT ?>css/common.css">
  <link rel="stylesheet" href="<?php echo ROOT ?>css/admin.css">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="<?php echo ROOT ?>js/admin.js"></script>

  <!-- button -->
  <link rel="stylesheet" type="text/css" href="<?php echo ROOT ?>lib/CreativeButtons/css/default.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo ROOT ?>lib/CreativeButtons/css/component.css" />
  <script src="<?php echo ROOT ?>lib/CreativeButtons/js/modernizr.custom.js"></script>
  <script src="<?php echo ROOT ?>js/instafeed.min.js"></script>
  <script type="text/javascript">
  var feed = new Instafeed({
      clientId: '93453d0cb7454313a327d2dc733dc68e',
      get: 'user',
      userId: '2067113655',
      accessToken: '<?php echo $data[1]['instagram_token'] ?>',
      links: true,
      limit: 1, // 取得件数
      template: '<a data-imageurl="{{image}}" style="display:none;"></a>'
  });
  feed.run();

  $(window).on("load",function(){
  	var instafeed_length = $('#admin_setting>#instafeed>a').length;
  	console.log('instafeed length : ' + instafeed_length);
  	if(instafeed_length){
  		$('.instafeed_check').html('表示可');
  	}else{
  		$('.instafeed_check').addClass('err').html('表示不可');
  	}
  });
  </script>
</head>
<body id="admin_setting">
	<header>
  	<?php include_once ROOTDIR.'admin/admin_header.php' ?>
  </header>
  <div id="instafeed"></div>
<?php if(!empty($db_table)){ ?>
  <form action="<?php echo ROOT ?>admin/db_update.php?<?php echo $get ?>" method="post">
    <div class="table">
      <div class="tr instafeed_status">
        <div class="th">インスタグラム表示状態</div>
        <div class="td"><p class="instafeed_check"></p></div>
      </div>
    <?php
    foreach ($data[1] as $key => $value) {//データ行を参照
      if(preg_match('/[^0-9]/', $key)){//必要データのみ参照
        if($key == 'id' || $key == 'uptime'){ continue; }
        if($key == 'instagram_token'){
          echo '<div class="tr '.$key.'">';
          echo '<div class="th">'.$data[0][$key].'<a href="https://instagram.com/oauth/authorize/?client_id=93453d0cb7454313a327d2dc733dc68e&redirect_uri=http://bond-botanical.jp&response_type=token">再取得</a></div>';
          echo '<div class="td"><p>'.$value.'<span>前回更新日時：'.$data[1]['uptime'].'</span></p></div>';
          echo '</div>';
        }else{
          echo '<div class="tr '.$key.'">';
          echo '<div class="th">'.$data[0][$key].'</div>';
       	  echo '<div class="td">';
          echo '<input type="text" name="'.$key.'" value="'.$value.'">';
          echo '</div>';
          echo '</div>';
        }
      }
    }
    ?>

    </div>
    <!--<button type="submit" class="btn btn-7 btn-7h icon-cog<?php echo $btn_class ?>">Update</button>-->
  </form>
<?php } ?>

<script src="<?php echo ROOT ?>lib/CreativeButtons/js/classie.js"></script>
</body>
</html>
